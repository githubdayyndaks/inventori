<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Support\Facades\Session;



use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    // Method untuk menambahkan notifikasi ke dalam session
    public function addNotification($notif)
    {
        $namaPeminjam = 'nama_peminjam';
        // Ambil data peminjaman berdasarkan nama peminjam
        $peminjaman = Peminjaman::where('nama_peminjam', $namaPeminjam)->latest()->first();
    
        // Periksa apakah data peminjaman ditemukan
        if ($peminjaman) {
            // Ambil tanggal pinjam
            $tanggal_pinjam = $peminjaman->tanggal_pinjam->format('d-m-Y H:i');
        } else {
            // Jika data peminjaman tidak ditemukan, berikan tanggal kosong
            $tanggal_pinjam = null;
        }
    
        $notifications = session()->get('notifikasi', []);
        $notifications[] = $notif;
        session()->put('notifikasi', $notifications);
    
        // Update jumlah notifikasi
        session()->put('jumlah_notifikasi', count($notifications));
    
        return $tanggal_pinjam;
    }
    
    
    
    
public function updateNotificationCount(Request $request)
{
    $jumlahNotifikasi = $request->input('jumlah_notifikasi');
    session()->put('jumlah_notifikasi', $jumlahNotifikasi);
    return response()->json(['status' => 'success']);
}

public function hapus($id) {
    $notification = Notification::findOrFail($id);
    $notification->delete();
    return response()->json(['message' => 'Notifikasi berhasil dihapus']);
}

public function hapusSemua() {
    Notification::truncate();
    return response()->json(['message' => 'Semua notifikasi berhasil dihapus']);
}



}
