<?php

use App\Http\Controllers\Back\AdminController;
use App\Http\Controllers\Back\BarangController;
use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Back\KategoriController;
use App\Http\Controllers\Back\KondisiController;
use App\Http\Controllers\Back\NotifikasiController;
use App\Http\Controllers\Back\PeminjamanController;
use App\Http\Controllers\Back\PersetujuanController;
use App\Http\Controllers\Back\ProfileController;
use App\Http\Controllers\Back\RuanganController;
use App\Http\Controllers\Back\SettingController;
use App\Http\Controllers\Back\SubkategoriController;
use App\Http\Controllers\Back\UserController;
use App\Http\Controllers\SesiController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('Landingpage.index');
});

Route::middleware(['guest'])->group(function(){
    Route::get('/login', [SesiController::class, 'index'])->name('login'); 
    Route::post('/login', [SesiController::class, 'login'] );     
});


Route::middleware(['auth'])->group(function(){
    Route::get('/inventory', [DashboardController::class, 'index']);
    Route::get('/inventory/admin', [DashboardController::class, 'index'])->name('admin.index')->middleware('userAkses:admin');
    Route::get('/inventory/petugas', [DashboardController::class, 'petugas'])->name('petugas.index')->middleware('userAkses:petugas');
    Route::get('/inventory/pengguna', [DashboardController::class, 'pengguna'])->name('pengguna.index')->middleware('userAkses:pengguna');
    Route::get('/logout', [SesiController::class, 'logout'])->name('logout');
    Route::get('/profile' ,[ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // route crud 
    route::resource('/users', UserController::class);
    route::resource('/setting', SettingController::class);
    route::resource('/ruangan', RuanganController::class);  
    route::resource('/kategori', KategoriController::class);
    route::resource('/subkategori', SubkategoriController::class);
    Route::resource('/persetujuan', PersetujuanController::class);

Route::post('/pinjam/barang', [BarangController::class, 'pinjam'])->name('pinjam.barang');
Route::post('/barang/pinjam', 'Back\BarangController@pinjam')->name('barang.pinjam');
Route::get('/index', 'YourController@index')->name('index');

    Route::resource('/peminjaman', PeminjamanController::class);
    Route::put('/peminjaman/{id}', [PeminjamanController::class, 'update']);
    Route::post('/peminjaman/simpan', [PeminjamanController::class, 'simpan'])->name('peminjaman.simpan');
    Route::get('/search-barang', [PeminjamanController::class, 'searchBarang'])->name('search.barang');
    Route::get('/peminjamanku', [PeminjamanController::class, 'peminjamanku']);

    Route::post('/update-notification-count', [NotifikasiController::class, 'updateNotificationCount'])->name('update.notification.count');
    Route::delete('/hapus-notifikasi/{id}', [NotifikasiController::class, 'hapus']);
    Route::delete('/hapus-semua-notifikasi', [NotifikasiController::class, 'hapusSemua']);
    Route::get('/get-notification-count', [NotifikasiController::class, 'getNotificationCount'])->name('get.notification.count');
    Route::post('/kembalikan-peminjaman', [PeminjamanController::class, 'kembalikanPeminjaman']);

    Route::get('/get-barang-details/{kode_barang}', [PeminjamanController::class, 'getBarangDetails']);
    Route::get('get-last-nomor-urutan/{kodeKategori}', [SubkategoriController::class, 'getLastNomorUrutan']);

    route::resource('/barang', BarangController::class);
    Route::get('get-subkategori/{kode_kategori}', [BarangController::class, 'getSubkategori']);
    Route::get('get-merk-jenis/{kode_subkategori}', [BarangController::class, 'getMerkJenis']);

    
});
 

//  redirect ke halaman dashboard sesuai level 
Route::get('/inventory/barang', function () {
    $user = auth()->user();
    if ($user->level == 'admin') {
        return Redirect::route('admin.index');
    } elseif ($user->level == 'petugas') {
        return Redirect::route('petugas.index');
    } elseif ($user->level == 'pengguna') {
        return Redirect::route('pengguna.index');
    } else {
        return Redirect::route('home');
    }
})->name('redirect.dashboard');