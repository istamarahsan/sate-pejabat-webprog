<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

class AuthorizeAdmin extends Authenticate
{
    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);

        if (auth()->user()->user_type != 'admin') {
            return response('Unauthorized', 401);
        }

        return $next($request);
    }
}
