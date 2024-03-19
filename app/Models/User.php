<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     protected $primaryKey = 'id_user';
    protected $fillable = [
        'id_user',
        'name',
        'email',
        'email_verified_at',
        'password',
        'level',
        'foto',
        'telepon',
    ];

    protected $dates = ['email_verified_at'];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function barang()
{
    return $this->hasMany(Barang::class, 'id');
}

public function isAdmin()
{
    return $this->level === 'admin';
}

public function isPetugas()
{
    return $this->level === 'petugas';
}

}