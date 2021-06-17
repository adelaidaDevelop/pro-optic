<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

use Illuminate\Support\Facades\Auth;
class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        //return NULL;
        if (! $request->expectsJson()) {
            
            //return route('login');
            return redirect('/');
        }
        /*if(session()->has('idEmpleado'))
        {
            return redirect('/');
            //$idEmpleado = session('idEmpleado');
            //Auth::loginUsingId($idEmpleado);
        }
        if(!Auth::check())
        {
            if(session()->has('idEmpleado'))
            {
                $idEmpleado = session('idEmpleado');
                Auth::loginUsingId($idEmpleado);
            }else
            {
                if (! $request->expectsJson()) {
                    return route('login');
                }
            }
        }*/
        
        /*if(Auth::check()) 
        {
            /*if(Auth::user()->tipo == 0)
                return redirect(RouteServiceProvider::HOME);
            if(Auth::user()->tipo == 1)
                return redirect(RouteServiceProvider::HOME);
            if(Auth::user()->tipo == 2)
                //session(['idCliente' => 'Si esta cambiando']);
                return 'Si entra aqui';
                //session(['idCliente' => Auth::user()->id]);
        }*/
    }
}