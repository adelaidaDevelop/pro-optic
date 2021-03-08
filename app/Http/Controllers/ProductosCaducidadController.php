<?php

namespace App\Http\Controllers;

use App\Models\Productos_caducidad;
use App\Models\Sucursal_producto;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductosCaducidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        ///$now = new \DateTime();
        //$now->format('d-m-Y H:i:s');
        ///$now->add(new \DateInterval('P2M'));
        ///$fechaActual = $now->format('Y-m-d');
        //$productosCaducidad = Productos_caducidad::all();
        ///$productosCaducidad = Productos_caducidad::whereDate('fecha_caducidad','<',$fechaActual)->get();
        //->whereDate('fecha_caducidad','<','2021-')->get();
        $productosCaducidad = Productos_caducidad::all();
        $productos = Producto::all();
        $vista = view('ProductosCaducidad.index',compact('productosCaducidad','productos'));
        return $vista;//view('ProductosCaducidad.index',compact('productosCaducidad'));
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
        $productoCaducidad = new Productos_caducidad;
        //$productoCaducidad->
        return request();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        if($id == 'todos')
        {
            //$sucursales = ProductosCaducidad::where('idSucursal', '=',);
            return Productos_caducidad::all();
        }
        $productos = Producto::all();
        $sucursalProducto = Sucursal_producto::where('idSucursal', '=',$id)->get();
        $productoCaducidad = Productos_caducidad::all();//where('idSucursalProducto','=',$sP->id)->get();
        
        $productosC = [];
        foreach($productoCaducidad as $pC)
        {
            foreach($sucursalProducto as $sP)
            {
                if($sP->id == $pC->idSucursalProducto)
                {
                    $i = 0;
                    while($i<count($productos))
                    {
                        if($productos[$i]->id == $sP->idProducto)
                        {
                            $pC->nombre = $productos[$i]->nombre;
                            $pC->codigoBarras = $productos[$i]->codigoBarras;
                            $i = count($productos);
                        }
                        else
                            $i++;
                    }
                    array_push($productosC, $pC);
                    //$productos = Arr::add($productos, 'numero', 6);
                }
            }
        }
        return $productosC;//ProductosCaducidad::where('idSucursalProducto', '=',$id)->get();
        //ProductosCaducidad::all(); $sucursales;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function edit(cr $cr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        if($request['oferta'] == true)
        {
            return Productos_caducidad::findOrFail($id)->update(['oferta' => true,'cantidad' =>$request['cantidad']]);
        }
        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Productos_caducidad::destroy($id);
        return 'true';
    }

    public function caducidad()
    {
        return view('Producto.caducidad');
    }
}
