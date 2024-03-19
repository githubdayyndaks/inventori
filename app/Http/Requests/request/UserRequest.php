<?php

namespace App\Http\Requests\request;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'foto'                  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name'                  => 'required|min:3',
            'telepon'               => 'nullable|min:10',
            'level'                 => 'required',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8'
        ];
    }
}
