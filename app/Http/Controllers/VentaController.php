<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use Illuminate\Http\Request;
use App\Models\Detalle_venta;


class VentaController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datosP= Producto::all();
        $datos['departamentos'] = Producto::paginate();
        return view('Venta.index',compact('datosP'));
        //return compact('datosP');
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
        $datosP= Producto::all();
        $datos['departamentos'] = Producto::paginate();
        $datos = $request->input('datos');
        $datosCodificados = json_decode($datos,true);
        $venta = Venta::create([
            'estado' => 'vendido',
            'idEmpleado' => 1,
        ]);
        
        foreach($datosCodificados as $datosProducto)
        {
            $producto = new Detalle_venta;
            $producto->cantidad = $datosProducto['cantidad'];
            $producto->producto = $datosProducto['nombre'];
            $producto->subtotal = $datosProducto['subtotal'];
            $producto->idVentas = $venta->id;
            $producto->save();
        }

        return "Si funciona";//view('Venta.index',compact('datosP'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function show(Venta $venta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function edit(Venta $venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venta $venta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venta $venta)
    {
        //
    }

    public function productos(Request $request)
    {
        //return view('Venta.formulario');
        $datos = $request->input('datos');
        $no = $request->input('no');
        return $datos;//compact($datos);//compact('no');
    }
}
