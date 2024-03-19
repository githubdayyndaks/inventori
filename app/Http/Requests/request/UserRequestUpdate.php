<?php

namespace App\Http\Requests\Request;

use Illuminate\Foundation\Http\FormRequest;

class UserRequestUpdate extends FormRequest
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
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|min:3',
            'telepon' => 'nullable|min:10',
            'level' => 'nullable',
            'email' => 'required|email',
            'password' => 'nullable|min:8|confirmed',
            'password_confirmation' => 'nullable|min:8|required_with:password'
        ];
    }
}
