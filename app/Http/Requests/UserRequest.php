<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'username' => 'required|min:3',
            'email' => 'email',
            'password' => 'required|min:4|confirmed',
            'password_confirmation' => 'required|min:4',
            'phone_number' => 'required|min:10',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama wajib diisi!',
            'username.required' => 'Username wajib diisi!',
            'phone_number.required' => 'Kontak wajib diisi!',
            'password.min' => 'Password minimal 4 huruf!',
            'password.confirmed' => 'Password dan konfirmasi password tidak sama!',
            'password_confirmation.required' => 'Konfirmasi password wajib diisi!',
            'password_confirmation.min' => 'Konfirmasi password minimal 4 huruf!',
        ];
    }
}
