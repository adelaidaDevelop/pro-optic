<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Compra_producto;
use App\Models\Producto;
use App\Models\Productos_caducidad;
use App\Models\Departamento;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datosProd['producto'] = Producto::paginate();
        $depas['d']= Departamento::paginate();
        $departamento= Departamento::all();
        $datosP= Producto::all();
        return view('Compra.index',$depas, compact('departamento','datosP'));
        //return view('Compra.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productos = Producto::all();
        $departamentos = Departamento::all();
        return view('Compra.create', compact('productos','departamentos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$datosP= Producto::all();
        //$datos['departamentos'] = Producto::paginate();
        $datos = $request->input('datos');
        $proveedor = $request->input('proveedor');
        $datosCodificados = json_decode($datos,true);
        $compra = Compra::create([
            'proveedor' => $proveedor,
        ]);
        
        foreach($datosCodificados as $datosProducto)
        {
            $producto = new Compra_producto;
            $producto->idCompras = $compra->id;
            $producto->idProductos = $datosProducto['id'];
            $producto->cantidad = $datosProducto['cantidad'];
            $producto->porcentaje_ganancia = $datosProducto['ganancia'];
            $producto->fecha_caducidad = $datosProducto['caducidad'];
            $producto->costo_unitario = $datosProducto['costo'];
            $producto->iva = 'Si';
            //$producto->fecha_caducidad = Carbon::createFromFormat( 'Y/m/d', $datosProducto['caducidad']);
            $producto->save();
            $actualizarProducto = Producto::find($datosProducto['id']);//->update(['existencia'=>]);
            $actualizarProducto->existencia = $actualizarProducto['existencia'] + $datosProducto['cantidad'];
            $actualizarProducto->costo = $datosProducto['costo'];
            $actualizarProducto->precio = $datosProducto['precio'];
            $actualizarProducto->save();

            $productoCaducidad = new Productos_caducidad;
            $productoCaducidad->idProducto = $datosProducto['id'];
            $productoCaducidad->fecha_caducidad = $datosProducto['caducidad'];
            $productoCaducidad->cantidad = $datosProducto['cantidad'];
            $productoCaducidad->save();
        }

        return true;//view('Venta.index',compact('datosP'));
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function show(Compra $compra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function edit(Compra $compra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Compra $compra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function destroy(Compra $compra)
    {
        //
    }

    public function buscadorProducto(Request $request)
    {
        //$datosConsulta['departamentosB'] = Departamento::where("nombre",'like',$request->texto."%")->get();
        $productos = Producto::where("nombre",'like',$request->texto."%")->get();
        return view('Compra.form',compact('productos'));
        //return compact('productos');
    }
}
?>