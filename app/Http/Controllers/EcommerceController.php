<?php

namespace App\Http\Controllers;
use App\Models\Producto;
use Illuminate\Http\Request;

class EcommerceController extends Controller
{
    public function __construct()
    {
        //return 'Entra aqui';
        //$this->middleware('isEmpleado');
        
    }
    public function index()
    {
        //$this->middleware('isCliente');
        //return 'Esta entrando x2';
        $productos = Producto::all();
        return view('Ecommerce.index',compact('productos'));
        //return session('idCliente');
        //return session('idEmpleado');
    }
}
