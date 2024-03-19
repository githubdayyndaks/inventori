<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'setting';
    protected $primaryKey = 'id_setting';
    protected $fillable = [
        'nama_sekolah',
        'jalan',
        'kelurahan',
        'kecamatan',
        'kabkot',
        'provinsi',
        'email',
        'website',
        'npsn',
        'kodepos',
        'telepon',
        'path_logo'
    ];

}
