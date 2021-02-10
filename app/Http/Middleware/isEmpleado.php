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
        if(session()->has('idEmpleado'))
        {
            if(Auth::check())
            {
                if(Auth::user()->tipo == 0)
                {
                    return $next($request);
                }
                Auth::logout();
            }
            $idEmpleado = session('idEmpleado');
            Auth::loginUsingId($idEmpleado);
            
        }
        else
        {
            Auth::logout();
            return redirect('/puntoVenta/login');
        }
            
        if(Auth::check())
            {
                $idEmpleado = Auth::user()->id;
                session(['idEmpleado' => $idEmpleado]); 
            }
        
        return $next($request);
    }
}