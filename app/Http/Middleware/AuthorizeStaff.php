<?php

namespace App\Http\Middleware;

use Closure;

class AuthorizeStaff extends Authenticate
{
    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);

        if (auth()->user()->user_type != 'staff' && auth()->user()->user_type != 'admin') {
            return response('Unauthorized', 401);
        } else {
            return $next($request);
        }
    }
}
