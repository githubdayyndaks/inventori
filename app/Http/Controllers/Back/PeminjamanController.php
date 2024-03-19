<?php

namespace App\Http\Controllers\Back;

use App\Events\PeminjamanCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Request\PeminjamanRequest;
use App\Http\Requests\Request\PeminjamanUpdateRequest;
use Illuminate\Http\Request;
use App\Models\Peminjaman; // Impor model Peminjaman
use App\Models\Barang;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Back\NotifikasiController;
class PeminjamanController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Mendapatkan informasi user yang sedang login

        $peminjaman = Peminjaman::with(['Barang', 'User'])
                        ->orderByRaw("id_user = $user->id_user DESC")
                        ->orderBy('id_user', 'DESC')
                        ->get();
    
        return view('back.peminjaman.index', [
            'peminjaman' => $peminjaman
        ]);
    }

    public function peminjamanku()
    {
        $user = Auth::user(); // Mendapatkan informasi user yang sedang login

        $peminjaman = Peminjaman::with(['Barang', 'User'])
                        ->where('id_user', $user->id_user)
                        ->orderBy('created_at', 'DESC')
                        ->get();
    
        return view('back.peminjaman.peminjamanku', [
            'peminjaman' => $peminjaman
        ]);
    }

public function searchBarang(Request $request)
{
    $searchTerm = $request->input('q');

    $barang = Barang::where('nama_barang', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('kode_barang', 'LIKE', "%{$searchTerm}%")
                    ->get();

    return response()->json($barang);
}

    public function getBarangDetails($id_peminjam)
{
        try {
            $barang = Peminjaman::where('id_peminjam', $id_peminjam)->first();
            if ($barang) {
                $data = [
                    'merk' => $barang->merk,
                    'kondisi' => $barang->kondisi,
                    'ukuran' => $barang->ukuran,
                    'bahan' => $barang->bahan,
                ];
                return response()->json([$data]);
            } else {
                return response()->json(['error' => 'Data not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show(string $id_pinjam)
    {
        return view('back.peminjaman.show',[
        'peminjaman' => Peminjaman::with(['Barang', 'User'])->find($id_pinjam)
        ]);
    }


    public function create()
    {
        $barang = Barang::all();
    
        return view('back.peminjaman.create', [
            'peminjaman'      => Peminjaman::get(),
            'barang'     => $barang,
   
        ]);
    }

    public function store(Request $request)
    {
        // Validasi data dari request menggunakan PeminjamanRequest yang sudah Anda buat
        $request->validate([
            'nama_barang' => 'required',
            'jumlah_barang' => 'required|numeric|min:1',
            'nama_peminjam' => 'required',
            'keterangan' => 'nullable',
        ]);
    
        // Ambil data dari request
        $namaBarang = $request->input('nama_barang');
        $jumlahBarang = $request->input('jumlah_barang');
        $namaPeminjam = $request->input('nama_peminjam');
        $keterangan = $request->input('keterangan');
    
        // Buat data peminjaman baru
        $peminjaman = new Peminjaman();
        $peminjaman->nama_barang = $namaBarang;
        $peminjaman->jumlah_barang = $jumlahBarang;
        $peminjaman->id_user = auth()->user()->id_user;
        $peminjaman->tanggal_pinjam = now();
        $peminjaman->nama_peminjam = $namaPeminjam;
        $peminjaman->keterangan = $keterangan;
    
        // Simpan data peminjaman
        $peminjaman->save();
    
        // Beri response JSON
        return response()->json(['message' => 'Data Peminjaman berhasil disimpan'], 200);
    }
    
    protected $notifikasiController;

    public function __construct(NotifikasiController $notifikasiController)
    {
        $this->notifikasiController = $notifikasiController;
    }
    public function simpan(Request $request)
    {
        // Validasi data dari request
        $request->validate([
            'nama_peminjam' => 'required',
            'data_barang' => 'required|array|min:1',
            'keterangan' => 'required',
        ]);
    
        // Memastikan pengguna telah login
        if (!auth()->check()) {
            return redirect()->back()->with('error', 'Anda harus login untuk melakukan tindakan ini.');
        }
    
        // Mengisi id_user dari pengguna yang sedang login
        $idUser = auth()->user()->id_user;
    
        // Simpan data peminjaman
        try {
            $namaPeminjam = $request->input('nama_peminjam');
            $keterangan = $request->input('keterangan');
            $tanggalPinjam = now(); // Sesuaikan dengan waktu peminjaman yang sebenarnya
    
            // Loop through each selected barang and save them as part of one peminjaman
            foreach ($request->input('data_barang') as $barangData) {
                $peminjaman = new Peminjaman();
                $peminjaman->nama_barang = $barangData['nama_barang'];
                $peminjaman->kode_barang = $barangData['kode_barang'];
                $peminjaman->jumlah_barang = $barangData['jumlah_barang'];
                $peminjaman->kondisi = $barangData['kondisi'];
                $peminjaman->merk = $barangData['merk'];
                $peminjaman->bahan = $barangData['bahan'];
                $peminjaman->ukuran = $barangData['ukuran'];
                $peminjaman->nama_peminjam = $namaPeminjam;
                $peminjaman->id_user = $idUser;
                $peminjaman->keterangan = $keterangan;
                $peminjaman->tanggal_pinjam = $tanggalPinjam;
                $peminjaman->save();
    
                // Panggil event PeminjamanCreated setiap kali sebuah peminjaman baru berhasil disimpan
                event(new PeminjamanCreated($peminjaman));
            }
    
            // Menambahkan notifikasi ke dalam session
            $notif = $namaPeminjam.' telah melakukan peminjaman barang';
    
            $peminjamanUrl = route('peminjaman.index');
    
            session()->flash('success', 'Data Peminjaman berhasil disimpan');
            return response()->json(['message' => 'Data Peminjaman berhasil disimpan', 'peminjaman_url' => $peminjamanUrl], 200);
    
        } catch (\Exception $e) {
            // Mengembalikan pesan kesalahan aktual dari pengecualian
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    
    
    


    public function edit(string $id_peminjaman)
    {
        return view('back.peminjaman.update', [
            'peminjaman'    => Peminjaman::find($id_peminjaman),
            'barang' => Barang::get(),
            'user' => User::get()
        ]);
    }
    
    public function update(PeminjamanUpdateRequest $request, string $id_peminjam){
        $data = $request->validated();
    
        // Mengisi id_user dari pengguna yang sedang login
        $data['id_user'] = auth()->user()->id_user;
    
        // Membuat record baru menggunakan Eloquent
        Peminjaman::find($id_peminjam)->update($data);
        
        return redirect(url('peminjaman'))->with('success', 'Data Peminjaman has been Update'); 
    }
 
    
    public function destroy(string $id_peminjam)
    {
        $data = Peminjaman::find($id_peminjam);
    
        if ($data) {
            $data->delete();
    
            return response()->json([
                "message" => 'Data Peminjaman has been deleted'
            ]);
        } else {
            return response()->json([
                "message" => 'Data Peminjaman not found'
            ], 404); // Return 404 Not Found jika data tidak ditemukan
        }
    }
    public function getPeminjaman()
    {
        // Ambil semua data peminjaman
        $peminjaman = Peminjaman::all();

        // Kembalikan data peminjaman
        return $peminjaman;
    }

    
    public function kembalikanPeminjaman(Request $request)
{
    $idPeminjam = $request->id_peminjam;

    // Lakukan logika untuk mengembalikan peminjaman dengan menggunakan $idPeminjam
    // Misalnya, perbarui status peminjaman menjadi 'Dikembalikan' dan catat tanggal pengembalian

    // Contoh:
    $peminjaman = Peminjaman::where('id_peminjam', $idPeminjam)->first();
    if ($peminjaman) {
        $peminjaman->status = 'dikembalikan';

        // Konversi zona waktu ke zona waktu lokal
        $tanggalPengembalian = now()->setTimezone('Asia/Jakarta');
        $peminjaman->tanggal_pengembalian = $tanggalPengembalian;

        $peminjaman->save();

        // Hapus data peminjaman dari database
        $peminjaman->delete();

        // Tindakan lanjutan, seperti memberikan respons atau mengembalikan data lain
        return response()->json(['status' => 'success', 'message' => 'Peminjaman berhasil dikembalikan']);
    } else {
        return response()->json(['status' => 'error', 'message' => 'Peminjaman tidak ditemukan']);
    }
}



    

}   
// Route::get('/get-barang-details/{kode_barang}', [PeminjamanController::class, 'getBarangDetails']);