<?php

namespace App\Http\Requests\Request;

use Illuminate\Foundation\Http\FormRequest;

class PeminjamanUpdateRequest extends FormRequest
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
            'nama_barang' => 'nullable',
            'kondisi' => 'nullable|in:baik,perbaikan,rusak',
            'id_user' => 'nullable',
            'tanggal_pinjam' => 'nullable',
            'tanggal_pengembalian' => 'nullable',
            'nama_peminjam' => 'nullable',
            'merk' => 'nullable',
            'bahan' => 'nullable',
            'ukuran' => 'nullable',
            'keterangan' => 'nullable',
            'jumlah_barang' => 'nullable',
            'status' => 'nullable',
        ];
    }
}
