<?php 

namespace App\Http\Middleware;
use \Firebase\JWT\JWT;

use Closure;
use Illuminate\Http\Response;
use App\Models\User;

class VerifyJwtToken 
{
    public function handle($request, Closure $next)
    {
        $key = JWT_KEY;

        $token = $request->header('Authorization');

        $userData = JWT::decode($token, $key, array('HS256'));

        $user = User::where('id', $userData->uid)
                ->first();

        if(!isset($user)){
            $status = 403;
            $response = [
                "message" => "User Unauthorized"
            ];
            return response(json_encode($response),$status);
        }
        
        $request->user = $user;
        
        return $next($request);
    }
}
