<?php

namespace App\Http\Requests\Request;

use Illuminate\Foundation\Http\FormRequest;

class SubkategoriRequest extends FormRequest
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
            'kode_subkategori' => 'required',
            'kode_kategori' => 'required',
            'nama_subkategori' => 'required|min:3',
            'jenis' => 'required|min:3',
            'merk' => 'required|min:3'
        ];
    }
}
