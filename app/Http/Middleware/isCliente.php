<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Domicilio;

use Illuminate\Support\Facades\Auth;


class isCliente
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
        if(session()->has('idCliente'))
        {
            if(Auth::check())
            {
                if(Auth::user()->tipo == 2)
                {
                    
                    return $next($request);
                }
                Auth::logout();
            }
            $idCliente = session('idCliente');
            Auth::loginUsingId($idCliente);
            
        }
        else
            Auth::logout();
        return $next($request);
    }
}