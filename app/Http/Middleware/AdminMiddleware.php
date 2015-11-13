<?php

namespace eppo\Http\Middleware;

use Closure;

class AdminMiddleware
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
		if (!$request->user() || !$request->user()->is_admin)
        {
            return redirect()->route('home')->with('warning-message', 'You are not authorized to access settings.');
        }
        return $next($request);
    }
}
