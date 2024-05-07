<?php

namespace App\Http\Middleware;

use Closure;

use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\Response;

class JwtMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {

        try {
            $user = JWTAuth::parseToken()->authenticate();
        
         } catch (Exception $e) {
              if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
             return Resp('','Token is Invalid', 403) ;
           }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
             return Resp('','Token is Expired', 401) ;
           }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenBlacklistedException){
             return Resp('','Token is Blacklisted', 400) ;
           }else{
                 return  Resp('','Authorization Token not found', 400) ;
           }
         }
            return $next($request);
    }
}
