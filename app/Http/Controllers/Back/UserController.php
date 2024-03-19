<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\request\UserRequest;
use App\Http\Requests\Request\UserRequestUpdate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
            $users = User::get();

        return view('back.user.index', [
            'users' => $users,
            
        ]);
    }

    public function create(){
        $users = User::all();
        return view('back.user.create', compact('users'));
    }

    public function store(UserRequest $request){
        $data = $request->validated();
     
        if ($request->hasFile('foto')) {
            // Simpan foto baru
            $foto = $request->file('foto');
            $fotoName = time() . '_' . $foto->getClientOriginalName();
            $foto->storeAs('fotoProfile', $fotoName, 'public');
            $data['foto'] = $fotoName;
        }

        $data['password'] = bcrypt($data['password']);
        User::create($data);
        $levels = User::all(); 
        return redirect(url('users'))->with('success', ' User has been created');
    }

    public function edit(string $id_user)
    {
        $levels = User::distinct('level')->pluck('level');
        $users = User::find($id_user);
        
        return view('back.user.update', [
            'users' => $users,
            'levels' => $levels
        ]);
    }
    
    
    public function update(UserRequestUpdate $request, $id_user){
        $data = $request->validated();

        // Periksa apakah ada file foto yang diunggah
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            $user = User::find($id_user);
            if ($user->foto) {
                // Pastikan foto lama ada sebelum mencoba menghapusnya
                Storage::delete('fotoProfile/' . $user->foto);
            }
        
            // Simpan foto baru
            $foto = $request->file('foto');
            $fotoName = time() . '_' . $foto->getClientOriginalName();
            $foto->storeAs('fotoProfile', $fotoName, 'public');
            $data['foto'] = $fotoName;
        }
    
        // Jika password tidak kosong, hash password baru
        if($request->filled('password')) {
            $data['password'] = bcrypt($data['password']);
        } else {
            // Jika password kosong, hapus input password dari data yang akan diupdate
            unset($data['password']);
            unset($data['password_confirmation']);
        }
    
        // Perbarui data pengguna
        User::find($id_user)->update($data);
    
        return redirect(url('users'))->with('success', ' User has been Update');
    }
    public function destroy(string $id_user)
    {
        $data = User::find($id_user);
    
        if ($data) {
            $data->delete();
    
            return response()->json([
                "message" => 'Data User has been deleted'
            ]);
        } else {
            return response()->json([
                "message" => 'Data User not found'
            ], 404); // Return 404 Not Found jika data tidak ditemukan
        }
    }
}
