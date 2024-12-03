<?php

namespace App\Http\Controllers;

use App\Http\Requests\Image;
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
            $form->logoGerencia = $request->file('logoGerencia')->store('public/fotos');
            $form->nombreObraPrograma = $request->nombreObraPrograma;
            $form->imagen = $request->file('imagen')->store('public/fotos');
            $form->montoInversion = $request->montoInversion;
            $form->descripcion = $request->descripcion;
            $form->beneficiarios = $request->beneficiarios;
            $form->codigoInversion = $request->codigoInversion;
            $form->tipoInversion = $request->tipoInversion;
            $form->estudiosPreliminares = $request->estudiosPreliminares;
            $form->save();
            return response()->json(['message' => 'Guardado']);
        }catch(Exception $e){
            return response()->json(['message' => 'ocurrio un error temporal', $e->getMessage()], 500);
        }
    }

    public function list()
    {
        try{    
            $items = Img::get();
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
}