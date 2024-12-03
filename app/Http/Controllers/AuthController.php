<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\LoginRequest;
use App\Services\GenerateTokens;
use App\Models\User;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        try  {
            $user = User::verifyCredentials($request->email, $request->password, 'web');
            if(!is_object($user)){
                switch($user){
                    case 1:
                        return response()->json([
                            'message' => 'El usuario no existe'
                        ], 404);
                        break;
                    case 2: 
                        return response()->json([
                            'message' => 'Contraseña incorrecta'
                        ], 403);
                        break;
                }
            }

            return response()->json(['tokenOperation' => GenerateTokens::operationToken($user->id),'tokenUpdate' => GenerateTokens::updateToken($user->id)           ], 200);
        } catch(\Exception $e){
            return response()->json(['message' => 'Fallo en la autenticación', $e->getMessage()], 500);
        }
    }
    
    public function refreshTokens(): JsonResponse
    {
        try {
            list($updateToken, $operationToken) = GenerateTokens::refreshTokens();
            return response()->json(['tokenUpdate' => $updateToken,'tokenOperation' => $operationToken], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ha ocurrido un error inesperado en su solicitud', $e->getMessage()], 500);
        }
    }
}