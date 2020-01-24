<?php

namespace App\Http\Middleware;

use Closure;

class OutgoingMiddleware
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
        if ($request->user()->acl == 1 || $request->user()->acl == 3 || $request->user()->acl == 4 || $request->user()->acl == 5)
        {
            return $next($request);
        }
        return redirect('accessdenied');
    }
}
