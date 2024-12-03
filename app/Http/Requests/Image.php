<?php

namespace App\Http\Requests;

use App\Http\Requests\Template;

class Image extends Template
{
    public function rules(): array
    {
        return [
            'nombreGerencia' => 'required|string',
            'gerenciaReferencia' => 'nullable|string',
            'colorGerencia' => 'nullable|string',
            'logoGerencia' => ['nullable', 'string'],
            'nombreObraPrograma' => 'nullable|string|max:1000',
            'imagen' => ['required', 'mimes:png,jpg,jpeg,gif'],
            'montoInversion' => 'required|string|max:1000',
            'descripcion' => 'required|string|max:2000',
            'beneficiarios' => 'required|string',
            'codigoInversion' => 'required|string',
            'tipoInversion' => 'nullable|string',
            'estudiosPreliminares' => 'nullable|string'
        ];
    }
}