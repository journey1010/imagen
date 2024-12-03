<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class image extends Model
{
    use HasFactory;

    protected $table = 'table_image';

    protected $fillable = [
        'nombre_gerencia',
        'sigla',
        'monto_inversion',
        'descripcion',
        'beneficiarios',
        'codigo_unico',
        'files'
    ];
}