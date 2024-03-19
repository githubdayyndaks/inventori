<?php

namespace App\Http\Controllers\Back;

use App\Events\BarangCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Request\BarangRequest;
use App\Http\Requests\Request\BarangUpdateRequest;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\Ruangan;
use App\Models\Subkategori;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Back\NotifikasiController;
use Illuminate\Support\Facades\Auth; // Import the Auth facade

class BarangController extends Controller
{
    public function index(){
        return view('back.barang.index',[
        'barang' => Barang::with(['Ruangan', 'Kategori', 'Subkategori', 'User'])->get()
        ]);
    }

    public function create()
    {
        $kategori = Kategori::all();
        $subkategori = Subkategori::all()->groupBy('kode_kategori');
        $user = User::all();
        $ruangan = Ruangan::all();
    
        $formattedSubkategori = [];
        foreach ($subkategori as $group) {
            foreach ($group as $item) {
                $formattedSubkategori[] = $item;
            }
        }
    
        return view('back.barang.create', [
            'barang'      => Barang::get(),
            'ruangan'     => $ruangan,
            'kategori'    => $kategori,
            'subkategori' => $formattedSubkategori,
            'User'        => $user
        ]);
    }
    

    public function getSubkategori($kode_kategori)
    {
        try {
            $subkategori = Subkategori::where('kode_kategori', $kode_kategori)->get();
            return response()->json($subkategori);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    public function getMerkJenis($kode_subkategori)
    {
        try {
            $subkategori = Subkategori::where('kode_subkategori', $kode_subkategori)->first();
            if ($subkategori) {
                $data = [
                    'merk' => $subkategori->merk,
                    'jenis' => $subkategori->jenis,
                ];
                return response()->json([$data]);
            } else {
                return response()->json(['error' => 'Data not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    public function show(string $kode_barang)
    {
        return view('back.barang.show',[
        'barang' => Barang::with(['Ruangan', 'Kategori', 'Subkategori', 'User'])->find($kode_barang)
        ]);
    }


    public function store(BarangRequest $request)
    {
        // Pastikan pengguna telah login
        if (!auth()->check()) {
            return redirect()->back()->with('error', 'Anda harus login untuk melakukan tindakan ini.');
        }
    
        // Validasi data dari request
        $data = $request->validated();
    
        // Mengisi id_user dari pengguna yang sedang login
        $data['id_user'] = auth()->user()->id_user;
    
        // Membuat record baru menggunakan Eloquent
        Barang::create($data);
    
        return redirect(url('barang'))->with('success', 'Data Barang has been created'); 
    }

    protected $notifikasiController;

    public function __construct(NotifikasiController $notifikasiController)
    {
        $this->notifikasiController = $notifikasiController;
    }
    

    public function edit($kode_barang){
        return view('back.barang.update', [
            'barang'    => Barang::find($kode_barang),
            'ruangan'     => Ruangan::get(),
            'kategori'    => Kategori::get(),
            'subkategori' => Subkategori::get(),
            'User'        => User::get()
        ]);
    }
    public function update(BarangUpdateRequest $request, string $kode_barang){
        $data = $request->validated();
    
        // Mengisi id_user dari pengguna yang sedang login
        $data['id_user'] = auth()->user()->id_user;
    
        // Membuat record baru menggunakan Eloquent
        Barang::find($kode_barang)->update($data);
        
        return redirect(url('barang'))->with('success', 'Data Barang has been Update'); 
    }

    public function destroy(string $kode_barang)
    {
        $data = Barang::find($kode_barang);
    
        if ($data) {
            $data->delete();
    
            return response()->json([
                "message" => 'Data Barang has been deleted'
            ]);
        } else {
            return response()->json([
                "message" => 'Data Barang not found'
            ], 404); // Return 404 Not Found jika data tidak ditemukan
        }
    }

    public function pinjam(Request $request)
    {
        // Validasi data yang diterima dari formulir
        $request->validate([
            'kode_barang' => 'required|exists:barang,kode_barang', // Pastikan kode barang yang diterima ada dalam tabel barang
        ]);
    
        // Ambil data kode barang dari formulir
        $kode_barang = $request->input('kode_barang');
    
        // Ambil data jumlah barang dari formulir, jika tidak tersedia, gunakan default 1
        $jumlah_barang = $request->input('jumlah_barang', 1);
    
        // Lakukan proses peminjaman barang
        $barang = Barang::where('kode_barang', $kode_barang)->firstOrFail();
    
        // Simpan informasi peminjaman ke dalam tabel peminjaman
        Peminjaman::create([
            'id_user' => Auth::id(), // User ID yang sedang meminjam barang
            'nama_peminjam' => Auth::user()->name, // Nama peminjam (username)
            'kode_barang' => $barang->kode_barang,
            'nama_barang' => $barang->nama_barang,
            'ruangan' => $barang->ruangan->nama_ruangan,
            'kategori' => $barang->kategori->nama_kategori,
            'subkategori' => $barang->subkategori->nama_subkategori,
            'merk' => $barang->merk,
            'jenis' => $barang->jenis,
            'kondisi' => $barang->kondisi,
            'bahan' => $barang->bahan,
            'ukuran' => $barang->ukuran,
            'jumlah_barang' => $jumlah_barang, // Menggunakan nilai jumlah barang dari formulir atau default 1 jika tidak disediakan
            // Tambahkan kolom lain yang ingin Anda simpan dalam tabel peminjaman
        ]);
    
        // Set status barang menjadi 'proses' setelah berhasil meminjam
        $barang->update(['status' => 'dipinjam']);
        $barang->update(['status' => 'dikembalikan']);
        $barang->update(['status' => 'ditolak']);
        $barang->update(['status' => 'proses']);
        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Barang dengan kode ' . $barang->kode_barang . ' (' . $barang->nama_barang . ') berhasil dipinjam oleh ' . Auth::user()->name . ' sebanyak ' . $jumlah_barang . ' dari ruangan ' . $barang->ruangan->nama_ruangan . '.');
    }
    
}
