<?php
namespace App\Http\Middleware;

use Closure;

class CorsMiddleware
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
        $headers = [
            'Access-Control-Allow-Origin'      => '*',
            'Access-Control-Allow-Methods'     => 'HEAD, POST, GET, OPTIONS, PUT, PATCH, DELETE',
            'Access-Control-Allow-Credentials' => 'true',
            'Access-Control-Max-Age'           => '86400',
            'Access-Control-Allow-Headers'     => 'Content-Type, Authorization, X-Requested-With',
            'Accept'                           => 'application/json'
        ];

        if ($request->isMethod('OPTIONS')){
            return response()->json('{"method":"OPTIONS"}', 200, $headers);
        }

        $response = $next($request);

        // $response->header('Access-Control-Allow-Methods', 'HEAD, GET, POST, PUT, PATCH, DELETE');
        // $response->header('Access-Control-Allow-Headers', $request->header('Access-Control-Request-Headers'));
        // $response->header('Access-Control-Allow-Origin', '*');

        // return $response;

        foreach($headers as $key => $value)
        {
            $response->header($key, $value);
        }

        return $response;
    }
}