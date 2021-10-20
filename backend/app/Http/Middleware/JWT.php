<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWT
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
        try {

            JWTAuth::parseToken()->authenticate();

        } catch(Exception $e){
            
            if($e instanceof TokenExpiredException){

                $newToken = JWTAuth::parseToken()->refresh();

                return response()->json(['status'=>'TOKEN_EXPIRED','token'=>$newToken],200);
                
            }else if($e instanceof TokenInvalidException){

                return response()->json(['error'=>'TOKEN_INVALID'],401);

            }else{
                
                return response()->json(['error'=>'TOKEN_NOT_FOUND'],401);
            }

        }
        
        
        return $next($request);
    }
}
