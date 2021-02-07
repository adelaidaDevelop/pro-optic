<?php

namespace App\Http\Controllers;
use App\Models\Producto;
use Illuminate\Http\Request;

class EcommerceController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return view('Ecommerce.index',compact('productos'));
        //return session('sucursal');
    }
}
