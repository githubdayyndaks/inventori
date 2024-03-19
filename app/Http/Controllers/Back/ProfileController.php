<?php

namespace App\Http\Controllers\Back;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function index()
    {
        // Ambil semua pengguna
        $users = User::all();
        // Ambil level pengguna sebagai opsi
        $options = User::pluck('level')->all();
        return view('back.profile.profile', [
            'users' => $users,
            'options' => $options
        ]);
    }


    public function update(Request $request)
    {


        $request->validate([
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Ubah sesuai kebutuhan validasi
            'name' => 'required|string|max:255',
            'telepon' => 'required|string|max:20', // Ubah sesuai kebutuhan
            // Tambahkan validasi lainnya sesuai kebutuhan
        ]);
    
        $users = auth()->user();

        // Update nama jika ada perubahan
        if ($request->has('name')) {
            $users->name = $request->name;
        }
    
        // Update telepon jika ada perubahan
        if ($request->has('telepon')) {
            $users->telepon = $request->telepon;
        }
    
        // Update foto profil jika ada perubahan
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($users->foto) {
                Storage::delete('fotoProfile/' . $users->foto);
            }
    
            // Simpan foto baru
            $foto = $request->file('foto');
            $fotoName = time() . '_' . $foto->getClientOriginalName();
            $foto->storeAs('fotoProfile', $fotoName, 'public');
            $users->foto = $fotoName;
        }
    
        $users->update();
    
        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui.');
    }
    
}
