<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function index(){
        return view('back.admin.index', [
            'total_users'    => User::count(),
            'total_barang'   => Barang::count()
        ]);
    }
    function petugas(){
        return view('back.petugas.index', [
            'total_users'    => User::count(),
            'total_barang'   => Barang::count()
        ]);
    }
    function pengguna(){
        return view('back.pengguna.index', [
            'total_users'    => User::count(),
            'total_barang'   => Barang::count()
        ]);
    }
}
