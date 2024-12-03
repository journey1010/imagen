<?php

namespace App\Services;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Carbon\Carbon;

use App\Models\User;
use Exception;

class GenerateTokens
{
    protected static $timeLifeUpdateToken = 525600;
    protected static $timeLifeOperationToken  = 120;
    protected static $iss = 'alertaciudadana.regionloreto.gob.pe'; 
    protected static $audUpdateToken = 'alerta105users.regionloreto.gob.pe';

    public static function updateToken(int $userId): string
    {
        $user = User::find($userId);
        $claims = [
            'iss' => static::$iss,
            'aud' => static::$audUpdateToken,
            'exp' => Carbon::now()->addMinutes(static::$timeLifeUpdateToken)->timestamp,
            'type' => 'update'
        ];

        $token = JWTAuth::customClaims($claims)->fromUser($user);
    
        return $token;
    } 
    
    public static function operationToken(int $userId): string 
    {
        $user = User::find($userId);
        $customClaims = [
            'iss' => static::$iss,
            'aud' => 'alerta105users.regionloreto.gob.pe',
            'exp' => Carbon::now()->addMinutes(static::$timeLifeOperationToken)->timestamp,
            'rol' => $user->rol,
            'type' => 'operation'
        ];

        $token = JWTAuth::customClaims($customClaims)->fromUser($user);
        
        return $token;
    }

    public static function refreshTokens(): array
    {
        try {
            
            $currentToken = JWTAuth::getToken();

            JWTAuth::checkOrFail();

            $payload = JWTAuth::getPayload($currentToken);

            $aud = $payload->get('aud');
            $iss = $payload->get('iss');
            $sub = $payload->get('sub');
            $type = $payload->get('type');
    
            if (static::$iss !== $iss || static::$audUpdateToken !== $aud[0] || $type != 'update') {
                throw new JWTException('Los claims esperados no coinciden con los proporcionados');
            }
            
            $user = User::find($sub);
   
            if (!$user) {
                throw new JWTException('El usuario está temporalmente restringido');
            }
            return [self::updateToken($user->id), self::operationToken($user->id), $user];
        } catch (JWTException $e) {
            throw $e; 
        } catch (Exception $e) {
            throw new JWTException('Error al refrescar el token: ' . $e->getMessage());
        }
    }

    public static function getRol()
    {
        try {
            $token = JWTAuth::parseToken();
            //$claims = $token->getPayload()->get('rol');
            return $token;
        } catch (\Exception $e){
            throw new Exception('Imposible obtener claims');
        }
    }

    public static function tokenForPasswordReset(\App\Models\User $user): string
    {
        $customClaims = [
            'sub' => $user->id,
            'email' => $user->email, 
            'exp' => Carbon::now()->addMinutes(15)->timestamp,
            'reset_password' => true
        ];
        
        $token = JWTAuth::customClaims($customClaims)->fromUser($user);
        return $token;
    }
}