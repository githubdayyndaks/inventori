<?php

namespace App\Http\Requests\Request;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'path_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nama_sekolah' => 'nullable|min:3',
            'jalan' => 'nullable|min:6',
            'provinsi'     => 'nullable',
            'kelurahan'     => 'nullable',
            'kecamatan'     => 'nullable',
            'kabkot'     => 'nullable',
            'email'     => 'nullable',
            'website'     => 'nullable',
            'npsn'     => 'nullable',
            'kodepos'     => 'nullable',
            'telepon' => 'nullable|min:10'
        ];
    }
}
