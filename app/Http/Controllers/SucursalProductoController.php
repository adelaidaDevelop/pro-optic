<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use App\Models\Sucursal_producto;
use App\Models\Producto;
use App\Models\Productos_caducidad;
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
    public function store(Request $request)
    {
        $datos = $request->input('datos');
        $datosCodificados = json_decode($datos,true);
        foreach($datosCodificados as $datosProducto)
        {
            //$actualizarProductoInd = Sucursal_producto::find($datosProducto['id']);//->update(['existencia'=>]);
            $sucursalProducto = new Sucursal_producto;//::where('idSucursal','=',session('sucursal'))
            //->where('idProducto', '=',$datosProducto['id'])->get()->first();
            $sucursalProducto->idSucursal = session('sucursal');
            $sucursalProducto->idProducto = $datosProducto['id'];
            $sucursalProducto->existencia = $datosProducto['cantidad'];
            $sucursalProducto->costo = $datosProducto['costo'];
            $sucursalProducto->precio = $datosProducto['precio'];
            $sucursalProducto->save();
            //$actualizarProductoInd->save();

            $productoCaducidad = new Productos_caducidad;
            $productoCaducidad->idSucursalProducto = $sucursalProducto->id;
            $productoCaducidad->fecha_caducidad = $datosProducto['caducidad'];
            $productoCaducidad->cantidad = $datosProducto['cantidad'];
            $productoCaducidad->oferta = false;
            $productoCaducidad->save();
        }

        
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
    public function show($id)//Sucursal_producto $sucursal_producto)
    {
        //if($id=='todos')
            return Sucursal_producto::where('idSucursal', '=',$id)->get();
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

    //ENVIAR DATOS: PRODUCTOS DADOS DE BAJA ESTA SUCURSAL
    public function productos_baja(){
        $idSucursal = session('sucursal');
        $productosBaja = Sucursal_producto::where('idSucursal', '=', $idSucursal)->where('status', '=', 0)->get();
       // $producto= Producto::findOrFail($productosBaja->idProducto)->get();
     //  $id= $productosBaja->idProducto->get();
      //  $producto = Producto::all();
        return  $productosBaja;
    }
    //ALTA PRODUCTO A SUCURSALES
    public function altaProductoS($id){
        $idSucursal = session('sucursal');
        $producto = Sucursal_producto::where('idSucursal', '=', $idSucursal)->where('idProducto', '=', $id);
        $dato['status']= 1;
        $producto->update($dato);
        return redirect()->back();
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
    public function update(Request $request,$id)//, Sucursal_producto $sucursal_producto)
    {
        
        if($id == 'productos')
        {
            $datos = $request->input('datos');
            $datosCodificados = json_decode($datos,true);
            
            foreach($datosCodificados as $datosProducto)
            {
                
                //$actualizarProductoInd = Producto::find($datosProducto['id']);//->update(['existencia'=>]);
                $actualizarProducto = Sucursal_producto::where('idSucursal','=',session('sucursal'))
                ->where('idProducto', '=',$datosProducto['id'])->get()->first();
                $actualizarProducto->existencia = $actualizarProducto['existencia'] + $datosProducto['cantidad'];
                
                $actualizarProducto->costo = $datosProducto['costo'];
                $actualizarProducto->precio = $datosProducto['precio'];
                $actualizarProducto->save();
                
                $productoCaducidad = new Productos_caducidad;
            
                $productoCaducidad->idSucursalProducto = $actualizarProducto->id;//$datosProducto['id'];
                $productoCaducidad->fecha_caducidad = $datosProducto['caducidad'];
                $productoCaducidad->cantidad = $datosProducto['cantidad'];
                $productoCaducidad->oferta = false;
                $productoCaducidad->save();
                
            }
            return 'Proceso terminado';
        }
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
