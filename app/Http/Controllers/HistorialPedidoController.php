<?php

namespace App\Http\Controllers;

use App\Models\historialPedido;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class HistorialPedidoController extends Controller
{
    public function index()
    {
        return view('Ecommerce.historialPedido');
    }
    public function index2()
    {
        return view('Ecommerce.seguimiento_pedido');
    }
    public function index3()
    {
        return view('Ecommerce.comprobante');
    }
    public function descargar(){
        /*
        $ventas = Venta::all();
        $pagos = Pago_venta::all();
        $devoluciones = Devolucion::all();
        $pagoCompras= Pago_compra::all();
        $compras = Compra::all();
        $empleados = Empleado::all();
        $idSucursal = session('sucursal');
        $sucursalEmpleados = Sucursal_empleado::where('idSucursal', '=', $idSucursal)->get();
   */
       $data = [
          //  'empleados' => $empleados,
           /* 'ventas' => $ventas,
            'pagos' => $pagos,
            'devoluciones' => $devoluciones,
            'pagoCompras' => $pagoCompras,
            'compras' =>$compras,
            'sucursalEmpleados' => $sucursalEmpleados
            */
        ];

        $pdf = PDF::loadView('Ecommerce\comprobante', $data)
        ->setPaper('a4', 'landscape');
        $pdf->save('corteCaja10.pdf');
        return back();
        return 1;
        return PDF::loadView('Ecommerce.comprobante', $data)
            ->stream('comprobantePaquete.pdf');
    }
    public function download()
    {
        $data = [
        ];
   // $pdf = PDF::loadView('Ecommerce\comprobante', $data)
    //->setPaper('a4', 'landscape');
      //  return $pdf->download('archivo.pdf');
     //   $pdf->save('archivo.pdf');
        return back();
    }

    public function imprimir(){

        $pdf = \PDF::loadView('imprimir');
        return $pdf->download('imprimir.pdf');
    }

    public function download2()
    {
       $pdf = PDF::loadView('header', [
        "nombre" => "Luis Cabrera Benito"]);
        return $pdf->download("mi_archivo.pdf");
    }

}
