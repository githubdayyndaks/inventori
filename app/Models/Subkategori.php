<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Subkategori extends Model
{
    use HasFactory;

    protected $table = 'subkategori';
    protected $primaryKey = 'kode_subkategori'; // Sesuaikan dengan primary key yang benar
    protected $keyType = 'string'; // Tipe data primary key adalah string
    public $incrementing = false;
    protected $fillable = [
        'kode_subkategori',
        'nama_subkategori',
        'kode_kategori',
        'jenis',
        'merk'
    ];


            //relasi ke kategori
            public function Kategori(): BelongsTo{
                return $this->belongsTo(Kategori::class, 'kode_kategori');
            }
}
