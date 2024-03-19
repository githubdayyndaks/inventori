<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Peminjaman extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_peminjam';  
    protected $table = 'peminjaman';
    protected $attributes = [
        'status' => 'proses', // Menjadikan 'status' default menjadi 'proses'
    ];
    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'kondisi',
        'id_user',
        'total_item',
        'tanggal_pinjam',
        'tanggal_pengembalian',
        'nama_peminjam',
        'merk',
        'bahan',
        'ukuran',
        'keterangan',
        'jumlah_barang',
        'status',
        // Tambahkan atribut lainnya sesuai struktur tabel
    ];


    public function Barang(): BelongsTo{
        return $this->belongsTo(Barang::class, 'kode_barang', 'kode_barang');
    }

    public function User(): BelongsTo{
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}