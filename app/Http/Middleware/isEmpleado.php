<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class isEmpleado
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //if(Auth::check())
        //{
            /*if(Auth::user()->tipo == 0)
                return redirect(RouteServiceProvider::HOME);
            if(Auth::user()->tipo == 1)
                return redirect(RouteServiceProvider::HOME);*/
            if(Auth::user()->tipo == 2)
            {
                Auth::logout();
                return redirect('/login');
            }
            /*$sucursal = $request->input('email');
            session(['sucursal' => $sucursal]);*///$sucursal]);
        //}
        return $next($request);
    }
}
