<?php

namespace CodeCommerce\Http\Middleware;

use Closure;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->header('origin') !== 'https://sandbox.pagseguro.uol.com.br' && $request->getMethod() !== 'POST') {
            return response('Unauthorized.', 401);
        }

        return $next($request)
            ->header('Access-Control-Allow-Origin', 'https://sandbox.pagseguro.uol.com.br')
            ->header('Access-Control-Allow-Methods', 'POST');
    }
}
