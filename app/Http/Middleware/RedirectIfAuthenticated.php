<?php

namespace App\Http\Middleware;

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
        if (Auth::guard($guard)->check()) {
            // return redirect('store');

            // Get user info
            $user = Auth::user();

            // Return back to access
            switch ($user->access_id) {
                case 1:
                    return redirect('office/dashboard');
                    break;
                case 2:
                    return redirect('store/dashboard');
                    break;
                case 3:
                    return redirect('store/dashboard');
                    break;
            }
        }

        return $next($request);
    }
}
