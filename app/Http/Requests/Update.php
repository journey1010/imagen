<?php

namespace App\Http\Requests;

use App\Http\Requests\Template;

class Update extends Template
{
    public function rules(): array
    {
        return [
            'id' => 'required|integer',
            'nombreGerencia' => 'nullable|string',
            'gerenciaReferencia' => 'nullable|string',
            'colorGerencia' => 'nullable|string',
            'logoGerencia' => ['nullable', 'string'],
            'nombreObraPrograma' => 'nullable|string|max:1000',
            'imagen' => ['nullable', 'mimes:png,jpg,jpeg,gif'],
            'montoInversion' => 'nullable|string|max:1000',
            'descripcion' => 'nullable|string|max:2000',
            'beneficiarios' => 'nullable|string',
            'codigoInversion' => 'nullable|string',
            'tipoInversion' => 'nullable|string',
            'estudiosPreliminares' => 'nullable|string',
            'tipoBeneficiario' => 'nullable|string'
        ];
    }
}
