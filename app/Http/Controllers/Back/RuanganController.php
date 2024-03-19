<?php

namespace App\Http\Controllers\Back;
use App\Http\Requests\Request\RuanganRequest;
use App\Http\Requests\Request\RuanganUpdateRequest;
use App\Models\Ruangan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class RuanganController extends Controller
{
    public function index(){
        return view('back.ruangan.index', [
        'ruangan' => Ruangan::get()
        ]);
    }   
    
    public function create()
    {
        $ruangan = Ruangan::all();
        return view('back.ruangan.create', compact('ruangan'));
    }
    
    public function store(RuanganRequest $request)
    {
        $data = $request->validated();
        Ruangan::create($data);
        return redirect(url('ruangan'))->with('success', 'Data Ruangan has been created'); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $kode_ruangan)
    {
        return view('back.ruangan.update', [
            'ruangan'    => Ruangan::find($kode_ruangan)
        ]);
    }
    public function update(RuanganUpdateRequest $request, string $kode_ruangan)
    {

        $data = $request->validated();
        Ruangan::find($kode_ruangan)->update($data);

        return redirect(url('ruangan'))->with('success', 'Data Ruangan has been Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $kode_ruangan)
    {
        $data = Ruangan::find($kode_ruangan);
    
        if ($data) {
            $data->delete();
    
            return response()->json([
                "message" => 'Data ruangan has been deleted'
            ]);
        } else {
            return response()->json([
                "message" => 'Data ruangan not found'
            ], 404); // Return 404 Not Found jika data tidak ditemukan
        }
    }
    
}
