<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {

            if (Auth::guard($guard)->check()) {

                if(auth()->user()->role_id == 1)
                {
                    return redirect(RouteServiceProvider::DASHBOARD_ADMIN);
                }
                else if(auth()->user()->role_id == Role::ADMIN_UNIVERSITAS)
                {
                    return redirect(RouteServiceProvider::DASHBOARD_UNIVERSITAS);
                }
                else if(auth()->user()->role_id == Role::ADMIN_FAKULTAS)
                {
                    return redirect(RouteServiceProvider::DASHBOARD_FAKULTAS);
                }
                else if(auth()->user()->role_id == 4)
                {
                    return redirect(RouteServiceProvider::DASHBOARD_PRODI);
                }
                // return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
