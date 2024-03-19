<?php

namespace App\Listeners;

use App\Events\PeminjamanCreated;
use App\Models\Notification;
use App\Models\Peminjaman;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PeminjamanCreated $event)
    {
        $peminjaman = $event->peminjaman;
        
        // Simpan notifikasi ke dalam database
        Notification::create([
            'id_user' => $peminjaman->id_user,
            'message' => 'Peminjaman baru oleh ' . $peminjaman->nama_peminjam,
            'read' => false,
        ]);
    }
    
}
