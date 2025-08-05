<?php

namespace App\Http\Controllers;

use App\Models\Venta_cliente;
use App\Models\Cliente;
use App\Models\Venta;
use App\Models\Producto;
use App\Models\Detalle_venta;
use App\Models\Pago_venta;
use App\Models\Sucursal_empleado;
use Illuminate\Http\Request;
use SebastianBergmann\Environment\Console;

class CreditoController extends Controller
{

    public function index()
    {
        $usuarios = ['verDeudor','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);
        $idSucursal = session('sucursal');
       $estado2= "incompleto";
        $venta_clientes= Venta_cliente::where('estado','=', $estado2)->get();
        $cliente= Cliente::all(['id', 'nombre','telefono','domicilio' ,'tipo','idUsuario','created_at','updated_at']);
        $ventas= Venta::all(['id', 'tipo','pago','status' ,'idSucursalEmpleado','created_at','updated_at']);
        $detalleVentas= Detalle_venta::all();
        $productos = Producto::all();
        $pagos_ventas= Pago_venta::all();
          return view('ListaDeudor.index', compact( 'venta_clientes', 'cliente','ventas','detalleVentas', 'productos','pagos_ventas'));
    }

    public function create()
    {
        return view('ListaDeudor.create');
    }

    public function store(Request $request)
    {
         $datosProducto = request()->except('_token');
         Venta_cliente::insert($datosProducto);
         return redirect('credito');
    }

    public function datosNuevos()
    {
        $credito= Venta_cliente::all();
        $cliente= Cliente::all();
        $ventas= Venta::all();
        $detalleVentas= Detalle_venta::all();
        $productos = Producto::all();
        $pagos= Pago_venta::all();
        return  compact( 'credito', 'cliente','ventas','detalleVentas', 'productos','pagos');
    }
}
