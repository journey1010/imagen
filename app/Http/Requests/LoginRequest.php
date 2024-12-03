<?php

namespace App\Http\Requests;

use App\Http\Requests\Template;

class LoginRequest extends Template
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required','email', 'max:255'],
            'password' => 'required|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Correo electrónico requerido',
            'email.email' =>  'Correo electrónico no tiene un formato valido',
            'email.max' => 'Correo electrónico non tiene un formato valido',
            'password.required' => 'Contraseña requerida',
            'password.max' => 'Contraseña excede el limite permitido de caracteres'
        ];
    }
}