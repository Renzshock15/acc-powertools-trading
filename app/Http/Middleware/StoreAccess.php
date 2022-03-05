<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class StoreAccess
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
        if (Auth::user()->access_id != 2 || Auth::user()->access_id != 3) {

            switch (Auth::user()->access_id) {
                case 1:
                    return redirect('office/dashboard');
                    break;
            }
        }
        return $next($request);
    }
}
