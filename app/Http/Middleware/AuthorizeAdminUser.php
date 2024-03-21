<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorizeAdminUser
{
    public function handle(Request $request, Closure $next): Response
    {
        if ( $request->user()->admin || $request->user()->isSuperAdmin() ) {
            return $next($request);
        }
        
        return abort(403, 'not authorized');
    }
}
