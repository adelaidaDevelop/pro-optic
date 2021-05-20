<?php

namespace App\Http\Controllers;

use App\Models\Pago_compra;
use App\Models\Proveedor;
use App\Models\Compra;
use App\Models\Sucursal_empleado;
use Illuminate\Http\Request;

class PagoCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = ['verPago','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        
        $pagosCompra = Pago_compra::all(); 
        $compras = Compra::all();
        $proveedores = Proveedor::all(); 
        return view('PagoCompra.index',compact('pagosCompra','compras','proveedores'));

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
        //
        $id = $request->input('id');
        $pago = $request->input('pago');
        $pagoCompra = new Pago_compra;
        $pagoCompra->monto = $pago;
        $pagoCompra->idCompra = $id;
        $pagoCompra->idEmpSuc = Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->id;
        $pagoCompra->save();

        return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pago_compra  $pago_compra
     * @return \Illuminate\Http\Response
     */
    public function show($idCompra)//Pago_compra $pago_compra)
    {
        if($idCompra == 'pagos')
            return Pago_compra::all();
        //$pagos = NULL;
        $pagos = Pago_compra::where('idCompra','=',$idCompra)->get();
        //if(isset($pagos))
          //  return 'pagos no encontrados';
        //else
            return $pagos;
        //var_dump();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pago_compra  $pago_compra
     * @return \Illuminate\Http\Response
     */
    public function edit(Pago_compra $pago_compra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pago_compra  $pago_compra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pago_compra $pago_compra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pago_compra  $pago_compra
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pago_compra $pago_compra)
    {
        //
    }
}
