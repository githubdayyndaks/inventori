<?php

namespace App\Events;

use App\Models\Peminjaman;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PeminjamanCreated
{

    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $peminjaman;

    public function __construct(Peminjaman $peminjaman)
    {
        $this->peminjaman = $peminjaman;
    }
    public function handle(Peminjaman $event)
    {
        // Lakukan logika untuk mengirim notifikasi kepada pengguna lain
        // Anda dapat mengakses informasi peminjaman melalui $event->peminjaman
        // Misalnya, Anda bisa mengirim notifikasi melalui email atau menyimpannya ke dalam sesi pengguna lain
        
        // Contoh:
        $peminjaman = $event->peminjaman;
        $namaPeminjam = $peminjaman->nama_peminjam;
        $notif = $namaPeminjam . ' telah melakukan peminjaman barang';
        
        // Simpan notifikasi ke dalam sesi pengguna lain
        session()->push('notifikasi', $notif);
        session()->put('jumlah_notifikasi', session()->get('jumlah_notifikasi', 0) + 1);
        
    }
}
