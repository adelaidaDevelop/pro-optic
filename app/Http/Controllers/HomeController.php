<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        //$this->middleware('isEmpleado');
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
    //    return session('idEmpleado');
        //return view('home');
        return redirect('puntoVenta/venta');//view('Venta.index');
       // return view('header2');
    //  return view('layouts.app');
    }
}
