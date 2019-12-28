<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

use App\Models\GroupUser;

class VerifyUserOfGroup
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $groupId = $request->id;
        $userId = $request->user->id;
        
        try {
            $groupUser = GroupUser::where(["user_id" => $userId, "group_id"=>$groupId])
                            ->first();

            if(!isset($groupUser)){
                throw new Exception("User does not belongs to group");
            }

            return $next($request);
        } catch (Exception $e){
            $status = 401;
            $response = [
                "exception" => $e,
                "message" => $e->getMessage()
            ];
            return response($response,$status);
        }
    }
}
