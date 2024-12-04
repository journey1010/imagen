<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class image extends Model
{
    use HasFactory;

    protected $table = 'table_image';

    protected $fillable = [
        'nombreGerencia',
        'gerenciaReferencia',
        'colorGerencia',
        'logoGerencia',
        'nombreObraPrograma',
        'imagen',
        'montoInversion',
        'descripcion',
        'beneficiarios',
        'codigoInversion',
        'tipoInversion',
        'estudiosPreliminares',
        'tipoBeneficiario'
    ];
}