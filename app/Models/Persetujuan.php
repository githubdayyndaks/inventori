<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Persetujuan extends Model
{
    use HasFactory;
    protected $table = 'peminjaman';
    protected $primaryKey = 'id_peminjam';
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
        'nama_peminjam',
        'merk',
        'bahan',
        'ukuran',
        'jumlah_barang',
        'status',
    ];

    public function Barang(): BelongsTo{
        return $this->belongsTo(Barang::class, 'kode_barang');
    }

    public function Peminjaman(): BelongsTo{
        return $this->belongsTo(Peminjaman::class, 'id_peminjam');
    }
    public function User(): BelongsTo{
        return $this->belongsTo(User::class, 'id_user');
    }
    
}
