<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use App\Models\Sucursal_producto;
use App\Models\Producto;
use Illuminate\Http\Request;

class SucursalProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        //
        
    }
    public function crear($id){
        return "creado";
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sucursal_producto  $sucursal_producto
     * @return \Illuminate\Http\Response
     */
    public function show(Sucursal_producto $sucursal_producto)
    {
        //
    }

    public function agregarProdStock_Suc($id){
        $producto= Producto::findOrFail($id);
        $datosSP['costo']= 0;
        $datosSP['precio']= 0;
        $datosSP['existencia']= 0;
        $datosSP['minimoStock']= 0 ;//$datosProducto['minimoStock'];
        $datosSP['status']= 1;
        $idSucursal = session('sucursal');
        $datosSP['idSucursal'] = $idSucursal;
        $datosSP['idProducto'] = $producto->id;
        Sucursal_producto::create($datosSP);

         return redirect('/puntoVenta/producto');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sucursal_producto  $sucursal_producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Sucursal_producto $sucursal_producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sucursal_producto  $sucursal_producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sucursal_producto $sucursal_producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sucursal_producto  $sucursal_producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sucursal_producto $sucursal_producto)
    {
        //
    }
}
