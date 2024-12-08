<?php

namespace App\Http\Controllers;

use App\Http\Requests\Image;
use App\Http\Requests\Update;
use App\Models\image as Img;
use App\Models\Offices;
use Exception;

class form extends Controller
{
    public function store(Image $request)
    {
        try{
            $form = new Img();
            $form->nombreGerencia = $request->nombreGerencia;
            $form->gerenciaReferencia = $request->gerenciaReferencia;
            $form->colorGerencia = $request->colorGerencia;
            $form->logoGerencia = $request->logoGerencia;
            $form->nombreObraPrograma = $request->nombreObraPrograma;
            $form->imagen = $request->file('imagen')->store('public/fotos');
            $form->montoInversion = $request->montoInversion;
            $form->descripcion = $request->descripcion;
            $form->beneficiarios = $request->beneficiarios;
            $form->codigoInversion = $request->codigoInversion;
            $form->tipoInversion = $request->tipoInversion;
            $form->estudiosPreliminares = $request->estudiosPreliminares;
            $form->tipoBeneficiario = $request->tipoBeneficiario;
            $form->save();
            return response()->json(['message' => 'Guardado']);
        }catch(Exception $e){
            return response()->json(['message' => 'ocurrio un error temporal'], 500);
        }
    }

    public function list()
    {
        try{    
            $items = Img::get();
            $items->map(function($item){
                $item->imagen = str_replace('public/', '', $item->imagen);
                return $item;
            });            
            return response()->json(['items' => $items ]);
        }catch(Exception $e){
            return response()->json(['message' => 'Problemas temporales'], 500);
        }
    }

    public function oficinas()
    {
        try{
            $items = Offices::select('name as nombre', 'init as sigla')->get();
            return response()->json($items, 200);
        }catch(Exception $e){
            return response()->json (['messaga' => 'Problemas temporales'], 500);
        }
    }

    public function update(Update $request)
    {
        try{
            $form = Img::find($request->id);

            if ($form) {
                if (!is_null($request->nombreGerencia)) {
                    $form->nombreGerencia = $request->nombreGerencia;
                }
                if (!is_null($request->gerenciaReferencia)) {
                    $form->gerenciaReferencia = $request->gerenciaReferencia;
                }
                if (!is_null($request->colorGerencia)) {
                    $form->colorGerencia = $request->colorGerencia;
                }
                if (!is_null($request->logoGerencia)) {
                    $form->logoGerencia = $request->logoGerencia;
                }
                if (!is_null($request->nombreObraPrograma)) {
                    $form->nombreObraPrograma = $request->nombreObraPrograma;
                }
                if ($request->hasFile('imagen')) {
                    $form->imagen = $request->file('imagen')->store('public/fotos');
                }
                if (!is_null($request->montoInversion)) {
                    $form->montoInversion = $request->montoInversion;
                }
                if (!is_null($request->descripcion)) {
                    $form->descripcion = $request->descripcion;
                }
                if (!is_null($request->beneficiarios)) {
                    $form->beneficiarios = $request->beneficiarios;
                }
                if (!is_null($request->codigoInversion)) {
                    $form->codigoInversion = $request->codigoInversion;
                }
                if (!is_null($request->tipoInversion)) {
                    $form->tipoInversion = $request->tipoInversion;
                }
                if (!is_null($request->estudiosPreliminares)) {
                    $form->estudiosPreliminares = $request->estudiosPreliminares;
                }
                if (!is_null($request->tipoBeneficiario)) {
                    $form->tipoBeneficiario = $request->tipoBeneficiario;
                }
                $form->save();
            
                return response()->json(['message' => 'Actualizado'], 200);
            }
            
            return response()->json(['message' => 'Registro no encontrado'], 404);            
        }catch(Exception $e){
            return response()->json (['messaga' => 'Problemas temporales'], 500);
        }
    }
}