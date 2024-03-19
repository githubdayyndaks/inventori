<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\Request\SettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        View::share('setting', $setting);

        return view('back.setting.index', compact('setting'));
    }
    
    public function edit(string $id_setting)
    {
        return view('back.setting.update', [
            'setting'    => Setting::find($id_setting)
        ]);
    }
    
    public function update(SettingRequest $request, $id_setting)
    {
        $data = $request->validated();

        // Periksa apakah ada file foto yang diunggah
        if ($request->hasFile('path_logo')) {
            // Hapus foto lama jika ada
            $setting = Setting::find($id_setting);
            if ($setting->foto) {
                // Pastikan foto lama ada sebelum mencoba menghapusnya
                Storage::delete('logo/' . $setting->foto);
            }
        
            // Simpan foto baru
            $foto = $request->file('path_logo');
            $fotoName = time() . '_' . $foto->getClientOriginalName();
            $foto->storeAs('logo', $fotoName, 'public');
            $data['path_logo'] = $fotoName;
        }
        Setting::find($id_setting)->update($data);
    
       
        return redirect(url('setting'))->with('success', ' Setting has been Update');
    }
}
