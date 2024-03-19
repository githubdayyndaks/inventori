<?php

namespace App\Http\Requests\Request;

use Illuminate\Foundation\Http\FormRequest;

class PeminjamanRequest extends FormRequest
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
            'kode_barang' => '',
            'nama_barang' => 'required',
            'kondisi' => 'required|in:baik,perbaikan,rusak',
            'id_user' => 'required',
            'tanggal_pinjam' => 'required',
            'nama_peminjam' => 'required',
            'merk' => 'required',
            'bahan' => 'required',
            'ukuran' => 'required',
            'jumlah_barang' => 'required',
        ];
    }
}
