<?php

namespace App\Http\Requests\Request;

use Illuminate\Foundation\Http\FormRequest;

class SubkategoriUpdateRequest extends FormRequest
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
            'kode_subkategori' => 'nullable',
            'kode_kategori' => 'nullable',
            'nama_subkategori' => 'nullable|min:3',
            'jenis' => 'nullable|min:3',
            'merk' => 'nullable|min:3'
        ];
    }
}
