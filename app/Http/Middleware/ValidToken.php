<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class ValidToken
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
        if ($request->header('x-valid-user') !== env('API_TOKEN')) {
            return Response::create('', 401);
        }
        return $next($request);
    }
}
