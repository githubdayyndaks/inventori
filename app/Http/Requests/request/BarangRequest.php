<?php

namespace App\Http\Requests\Request;

use Illuminate\Foundation\Http\FormRequest;

class BarangRequest extends FormRequest
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
            'kode_barang' => 'required',
            'kode_ruangan' => 'required',
            'kode_kategori' => 'required',
            'kode_subkategori' => 'required',
            'id_user' => 'required',
            'nama_barang' => 'required|min:3',
            'merk' => 'required|min:3',
            'jenis' => 'required|min:3',
            'bahan' => 'nullable|min:3',
            'ukuran' => 'nullable|min:3',
            'kondisi' => 'required|in:baik,perbaikan,rusak',
        ];
    }
}
