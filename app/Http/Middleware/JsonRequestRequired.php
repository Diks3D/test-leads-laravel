<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class JsonRequestRequired
{
    public function handle(Request $request, Closure $next)
    {
        if(empty($request->json()) || !is_array($request->json()->all()) || count($request->json()->all()) === 0) {
            abort(400, 'Invalid request body');
        }

        return $next($request);
    }
}