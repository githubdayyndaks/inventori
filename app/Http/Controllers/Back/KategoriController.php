<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\Request\KategoriRequest;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::get();
        return view('back.kategori.index', [
            'kategori' => $kategori
        ]);
    }
    
    
    
    public function create()
    {
        $kategori = Kategori::all();
        return view('back.kategori.create', compact('kategori'));
    }
    
    public function store(KategoriRequest $request)
    {
        $data = $request->validated();
        Kategori::create($data);
        return redirect(url('kategori'))->with('success', 'Data Kategori has been created'); 
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(string $kode_kategori)
    {
        return view('back.kategori.update', [
            'kategori'    => Kategori::find($kode_kategori)
        ]);
    }
    public function update(KategoriRequest $request, string $kode_kategori)
    {

        $data = $request->validated();
        Kategori::find($kode_kategori)->update($data);

        return redirect(url('kategori'))->with('success', 'Data Kategori has been Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $kode_kategori)
    {
        $data = Kategori::find($kode_kategori);
    
        if ($data) {
            $data->delete();
    
            return response()->json([
                "message" => 'Data kategori has been deleted'
            ]);
        } else {
            return response()->json([
                "message" => 'Data kategori not found'
            ], 404); // Return 404 Not Found jika data tidak ditemukan
        }
    }
    
}

