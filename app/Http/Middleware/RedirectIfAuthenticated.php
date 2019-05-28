<?php

namespace Rumi\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        switch($guard){
            case 'leaser':
            if (Auth::guard($guard)->check()) {
            return redirect(route('leaser.dashboard'));
        }
            break;
            
            case 'roomer':
            if (Auth::guard($guard)->check()) {
            return redirect(route('roomer.dashboard'));
        }
            break;

            default:
            if (Auth::guard($guard)->check()) {
            return redirect(route('user.dashboard'));
        }
        }
        

        return $next($request);
    }
}
