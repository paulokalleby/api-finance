<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthorizeAdminUser
{
    public function handle(Request $request, Closure $next): Response
    {
        if ( !Auth::user()->admin ) abort(403, 'not authorized');

        return $next($request);
    }
}
