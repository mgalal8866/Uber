<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ApiCheckKey
{

    public function handle(Request $request, Closure $next): Response
    {
        if ($request->header('api-token')  === 'TESTPOSTMAN') {
            // dd($request->header('api-token'));
            return $next($request);
        }
        if (env('API_KEY') != false) {

            $keys = DB::table('api_tokens')->where('token', $request->header('api-token'))->first();
            if ($keys == null || empty($keys)) {
                $data = [
                    'status' => 201,
                    'msg'    => 'Api Token Not Found'
                ];
                return response()->json($data);
            } else {
                $request->attributes->add(['source_api' => $keys->name]);
                return $next($request);
            }
        } else {
            // $data = [
            //     'status' => 400,
            //     'msg'    => 'Api Token Not Found'
            // ];
            // return response()->json($data);
            return $next($request);
        }
    }
}
