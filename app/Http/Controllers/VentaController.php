<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use App\Models\Departamento;
use App\Models\Cliente;
use App\Models\Credito;
use Illuminate\Http\Request;
use App\Models\Detalle_venta;
use App\Models\Pago;
use App\Models\Sucursal_producto;


class VentaController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware('isEmpleado');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datosP = Producto::all();
        $departamentos = Departamento::all();
        $clientes = Cliente::all();
        //$datos['departamentos'] = Producto::paginate();
        $idSucursal = session('sucursal');
        $productosSucursal = Sucursal_producto::where('idSucursal', '=',$idSucursal)->get();
        return view('Venta.index', compact('datosP', 'departamentos', 'clientes','productosSucursal'));
    //    return session('idEmpleado');
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
        $estado = $request->input('estado');
        $pago = $request->input('pago');
        $datosCodificados = json_decode($datos, true);

        if ($request->has('cliente')) {
            $cliente = $request->input('cliente');
            $venta = Venta::create([
                'estado' => $estado,
                'idEmpleado' => 1,
            ]);
            $credito = new Credito;
            $credito->estado = $estado;
            $credito->idCliente = $cliente;
            $credito->idVenta = $venta->id;
            $credito->save();
            if($pago > 0)
            {
            $pagoCredito = new Pago;
            $pagoCredito->monto = $pago;
            $pagoCredito->idVenta = $venta->id;
            $pagoCredito->save();
            }

        } else {
            $venta = Venta::create([
                'estado' => $estado,
                'idEmpleado' => 1,
                'pago' => $pago,
            ]);
        }
        foreach ($datosCodificados as $datosProducto) {
            $producto = new Detalle_venta;
            $producto->cantidad = $datosProducto['cantidad'];
            $producto->idProductos = $datosProducto['id'];
            $producto->precio_ind= $datosProducto['precio'];
            $producto->subtotal = $datosProducto['subtotal'];
            $producto->idVentas = $venta->id;
            $producto->save();

<<<<<<< HEAD
            $productosSucursal = Sucursal_producto::where('idProducto','=',$datosProducto['id'])
            ->where('idSucursal','=',session('sucursal'));//->update(['existencia'=>'11']);
            $existencia = $productosSucursal->first()->existencia - $datosProducto['cantidad'];
            $productosSucursal->update(['existencia'=> $existencia]);
            //$actualizarProducto = new Sucursal_producto;//return $datosProducto['cantidad'];
            //$actualizarProducto->idSucursal = session('sucursal');
            //$actualizarProducto->
            //$actualizarProducto->existencia = $productosSucursal['existencia'] - $datosProducto['cantidad'];
            //return $actualizarProducto;//->save();
=======
            $actualizarProducto = Sucursal_producto::where('idProducto','=',$datosProducto['id']); //->update(['existencia'=>]);
            //return $datosProducto['cantidad'];
            $actualizarProducto->existencia = $actualizarProducto['existencia'] - $datosProducto['cantidad'];
            //return $actualizarProducto->save();

>>>>>>> 8a2d7ce00e02e0b6e6c2f7a926355ab43dca8ab6
        }

        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function show(Venta $venta)
    {
        return view('Venta.ticket');
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
        return $datos; //compact($datos);//compact('no');
    }
}