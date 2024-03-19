<?php

namespace App\Listeners;
use App\Events\BarangCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendPeminjamanNotification
{
    public function handle(BarangCreated $event)
    {
        // Lakukan logika notifikasi untuk peminjaman barang yang terjadi pada model Barang
        $barang = $event->barang;
        $namaPeminjam = $barang->User->name;
        $notif = $namaPeminjam . ' telah melakukan peminjaman barang ' . $barang->nama_barang;

        // Simpan notifikasi ke dalam sesi pengguna lain
        session()->push('notifikasi', $notif);
        session()->put('jumlah_notifikasi', session()->get('jumlah_notifikasi', 0) + 1);
    }
}
