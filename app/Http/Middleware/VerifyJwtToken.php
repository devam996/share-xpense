<?php 

namespace App\Http\Middleware;
use \Firebase\JWT\JWT;

use Closure;
use Exception;
use Illuminate\Http\Response;
use App\Models\User;

class VerifyJwtToken 
{
    public function handle($request, Closure $next)
    {
        $key = JWT_KEY;

        try {
            $token = $request->header('X-AUTH-TOKEN');

            if(!isset($token)){
                throw new Exception("Token not found");
            }

            $userData = JWT::decode($token, $key, array('HS256'));

            $user = User::where('id', $userData->uid)
                    ->first();

            if(!isset($user)){
                throw new Exception("User Unauthorized");
            }
            
            $request->user = $user;
            return $next($request);

        } catch (Exception $e) {
            $status = 403;
            $response = [
                "exception" => $e,
                "message" => $e->getMessage()
            ];
            return response($response,$status);
        }
        
    }
}
