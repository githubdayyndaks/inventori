<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\Request\SubkategoriRequest;
use App\Http\Requests\Request\SubkategoriUpdateRequest;
use App\Models\Kategori;
use App\Models\Subkategori;
use Illuminate\Http\Request;

class SubkategoriController extends Controller
{
    public function index(){
        $subkategori = Subkategori::with('Kategori')->get();
        return view('back.subkategori.index', [
            'subkategori' => $subkategori
        ]);
    }

     
    public function create()
    {
        return view('back.subkategori.create', [
            'kategori' => Kategori::all()
        ]);
        
    }

    public function getLastNomorUrutan($kode_kategori)
{
    // Get the last subkategori for the given kode_kategori
    $lastSubkategori = Subkategori::where('kode_kategori', $kode_kategori)
                                  ->orderBy('kode_subkategori', 'desc')
                                  ->first();
    
    // If the last subkategori exists, extract the numeric part and increment it by 1
    if ($lastSubkategori) {
        $lastNomorUrutan = intval(substr($lastSubkategori->kode_subkategori, -3)) + 1;
    } else {
        // If no subkategori exists for the given kode_kategori, start from "001"
        $lastNomorUrutan = 1;
    }
    
    // Format the nomor urutan with leading zeros
    $nomorUrutanFormatted = sprintf('%03d', $lastNomorUrutan);
    
    return $nomorUrutanFormatted;
}

public function store(SubkategoriRequest $request)
{
    // Get the kode_kategori from the request
    $kode_kategori = $request->kode_kategori;
    
    // Get the next subkategori number
    $nomorUrutan = $this->getLastNomorUrutan($kode_kategori);
    
    // Format the next subkategori number with leading zeros
    $nomorUrutanFormatted = sprintf('%03d', $nomorUrutan);

    // Assign the formatted subkategori number to kode_subkategori
    $kodeSubkategori = $kode_kategori . '-' . $nomorUrutanFormatted;

    // Validate form input
    $data = $request->validated();
    $data['kode_subkategori'] = $kodeSubkategori;

    // Save the data to the database
    Subkategori::create($data);

    return redirect(url('subkategori'))->with('success', 'Data Subkategori has been created');
}
    

    
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $kode_subkategori)
    {
        return view('back.subkategori.update', [
            'subkategori'    => Subkategori::find($kode_subkategori),
            'kategori' => Kategori::get()
        ]);
    }

    public function update(SubkategoriUpdateRequest $request, string $kode_subkategori)
    {
        // Validasi data dari request
        $data = $request->validated();
    
        // Periksa apakah kode_kategori ada dalam data
        if (!isset($data['kode_kategori'])) {
            // Jika tidak ada, ambil kode_kategori dari data yang ada di database
            $subkategori = Subkategori::where('kode_subkategori', $kode_subkategori)->first();
            $data['kode_kategori'] = $subkategori->kode_kategori;
        }
    
        // Hapus 'kode_subkategori' dari data yang akan diupdate
        unset($data['kode_subkategori']);
    
        // Proses update data
        Subkategori::where('kode_subkategori', $kode_subkategori)
                   ->update($data);
    
        return redirect(url('subkategori'))->with('success', 'Data Subkategori telah diperbarui');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $kode_subkategori)
    {
        $data = Subkategori::find($kode_subkategori);
    
        if ($data) {
            $data->delete();
    
            return response()->json([
                "message" => 'Data Subkategori has been deleted'
            ]);
        } else {
            return response()->json([
                "message" => 'Data Subkategori not found'
            ], 404); // Return 404 Not Found jika data tidak ditemukan
        }
    }
}
