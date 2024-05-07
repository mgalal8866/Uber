<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiVersion
{
    public function handle(Request $request, Closure $next, $guard): Response
    {
    
        if (config('app.api_latest') == $guard) {
            return $next($request);
        } else {
            return response(['error' => 'Filed API V']);
        }
    }
}
