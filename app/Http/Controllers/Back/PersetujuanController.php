<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman; // Tambahkan use statement untuk model Peminjaman
use App\Models\Persetujuan;
use Illuminate\Support\Facades\Validator;

class PersetujuanController extends Controller
{
    /**
     * Menampilkan halaman persetujuan.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Ambil semua data peminjaman
        $peminjaman = Peminjaman::all();

        // Tampilkan view persetujuan dengan data peminjaman
        return view('back.persetujuan.index', compact('peminjaman'));
    }

    /**
     * Menampilkan detail persetujuan berdasarkan ID peminjaman.
     *
     * @param  string  $id_peminjam
     * @return \Illuminate\Http\Response
     */
    public function show(string $id_peminjam)
    {
        // Cari persetujuan berdasarkan ID
        $persetujuan = Persetujuan::with(['Barang', 'Peminjaman', 'User'])->find($id_peminjam);
    
        // Periksa apakah persetujuan ditemukan
        if (!$persetujuan) {
            return redirect()->back()->with('error', 'Persetujuan tidak ditemukan.');
        }
    
        // Jika persetujuan ditemukan, lanjutkan dengan menampilkan view
        return view('back.persetujuan.invoice', compact('persetujuan'));
    }

    /**
     * Menyetujui peminjaman.
     *
     * @param  int  $id_peminjaman
     * @return \Illuminate\Http\Response
     */
    
    
}
