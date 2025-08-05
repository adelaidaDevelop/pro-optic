<?php

namespace App\Http\Controllers;

use App\Models\Pago_compra;
use App\Models\Proveedor;
use App\Models\Compra;
use App\Models\Sucursal_empleado;
use Illuminate\Http\Request;

class PagoCompraController extends Controller
{
    public function index()
    {
        $usuarios = ['verPago','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);
        $pagosCompra = Pago_compra::all();
        $compras = Compra::all();
        $proveedores = Proveedor::all();
        return view('PagoCompra.index',compact('pagosCompra','compras','proveedores'));
    }

    public function store(Request $request)
    {
        $id = $request->input('id');
        $pago = $request->input('pago');
        $pagoCompra = new Pago_compra;
        $pagoCompra->monto = $pago;
        $pagoCompra->idCompra = $id;
        $pagoCompra->idEmpSuc = Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->id;
        $pagoCompra->save();
        return $request;
    }

    public function show($idCompra)
    {
        if($idCompra == 'pagos')
            return Pago_compra::all();
        $pagos = Pago_compra::where('idCompra','=',$idCompra)->get();
            return $pagos;
    }
}
