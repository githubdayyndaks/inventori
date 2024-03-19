<?php

namespace App\Http\Requests\Request;

use Illuminate\Foundation\Http\FormRequest;

class BarangUpdateRequest extends FormRequest
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
            'kode_barang' => 'nullable',
            'kode_ruangan' => 'nullable',
            'kode_kategori' => 'nullable',
            'kode_subkategori' => 'nullable',
            'id_user' => 'nullable',
            'nama_barang' => 'nullable|min:3',
            'merk' => 'nullable|min:3',
            'jenis' => 'nullable|min:3',
            'bahan' => 'nullable|min:3',
            'ukuran' => 'nullable|min:3',
            'kondisi' => 'nullable|in:baik,perbaikan,rusak',
        ];
    }
}
