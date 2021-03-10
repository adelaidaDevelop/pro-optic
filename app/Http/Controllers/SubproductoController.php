<?php

namespace App\Http\Controllers;

use App\Models\Subproducto;
use App\Models\Producto;
use App\Models\Departamento;
use Illuminate\Http\Request;
use App\Models\Sucursal_producto;

class SubproductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subproductos = Subproducto::all();
        $idSucursal = session('sucursal');
        $sucursalProd = Sucursal_producto::where('idSucursal', $idSucursal)->get();
        $productos = Producto::all();
          return view('Subproducto.index',compact('subproductos', 'productos','sucursalProd'));

/*
          $datosProd['producto'] = Producto::paginate();
          $departamentos['d']= Departamento::paginate();
          $departamento= Departamento::all();
              return view('Producto.index',$datosProd,$departamentos, compact('departamento'));
   */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //$idSucProd = 1;
       // $datosProd['producto'] = Producto::paginate(); necesito este: producto
       $idProd = $request->input('id');
       $datosP= Producto::all();
        $subproducto2['subproducto']= SubProducto::paginate();
         $producto=Producto::all();
         $depas = Departamento::all();
        $idSucursal = session('sucursal');
        $productosSucursal = Sucursal_producto::where('idSucursal', '=',$idSucursal)->get();
         return view('Subproducto.agregar', compact('producto', 'datosP', 'productosSucursal','depas','idProd'));
    }

    public function existeEnSubproducto(Request $request){
        $idProd = $request->input('id'); 
        $producto=Producto::all();
        $subproducto= Subproducto::all();
        $idSucursal = session('sucursal');
        $productosSucursal = Sucursal_producto::where('idSucursal', '=',$idSucursal)->get();
        return compact('producto',  'productosSucursal','idProd','subproducto');

        

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
       // $datosSubproducto = request()->except('_token');
        $datosSubproducto = $request->except('_token');
        $idSP = $datosSubproducto['idSucursalProducto'];
        $sucProd = Sucursal_producto::findOrFail($idSP);
        $idProducto = $sucProd['idProducto'];
       // $existenciaNue['existencia'] = 
       // return $idProducto;
       Subproducto::create($datosSubproducto);
       $actualizarProducto = Sucursal_producto::where('idSucursal','=',session('sucursal'))
        ->where('idProducto', '=', $idProducto)->get()->first();
        $existenciaNuevo['existencia'] = $actualizarProducto->existencia - 1;
        //return $existenciaNuevo;
       $actualizarProducto->update($existenciaNuevo);
       return redirect('puntoVenta/subproducto');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subproducto  $subproducto
     * @return \Illuminate\Http\Response
     */
    public function show(Subproducto $subproducto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subproducto  $subproducto
     * @return \Illuminate\Http\Response
     */
    public function edit(Subproducto $subproducto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subproducto  $subproducto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subproducto $subproducto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subproducto  $subproducto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subproducto $subproducto)
    {
        //
    }
}
