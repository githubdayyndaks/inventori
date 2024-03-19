<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Events\PeminjamanCreated;
use Illuminate\Support\Facades\Event;
class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $primaryKey = 'kode_barang';
    protected $keyType = 'string'; // Tipe data primary key adalah string
    public $incrementing = false;

    protected $fillable = [
        'kode_barang',
        'kode_ruangan',
        'kode_kategori',
        'kode_subkategori',
        'id_user',
        'nama_barang',
        'merk',
        'jenis',
        'bahan',
        'ukuran',
        'kondisi',
        'total_item'
    ];

    public function Ruangan(): BelongsTo{
        return $this->belongsTo(Ruangan::class, 'kode_ruangan');
    }

    public function Kategori(): BelongsTo{
        return $this->belongsTo(Kategori::class, 'kode_kategori');
    }

    public function Subkategori(): BelongsTo{
        return $this->belongsTo(Subkategori::class, 'kode_subkategori');
    }


    public function Peminjaman(): BelongsTo{
        return $this->belongsTo(Peminjaman::class, 'kode_barang', 'kode_barang');
    }

    public function User(): BelongsTo{
        return $this->belongsTo(User::class, 'id_user');
    }

    protected static function boot()
{
    parent::boot();

    static::created(function ($barang) {
        // Panggil event PeminjamanCreated
        event(new PeminjamanCreated($barang));
    });
}

}