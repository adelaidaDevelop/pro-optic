<?php

namespace App\Http\Controllers;

use App\Models\historialPedido;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class HistorialPedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('Ecommerce.historialPedido');
    }
    public function index2()
    {
        //
        return view('Ecommerce.seguimiento_pedido');
    }
    public function index3()
    {
        //
        return view('Ecommerce.comprobante');
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
        //return $pdf;
        $pdf->save('corteCaja10.pdf');
        return back(); 
        

        return 1;
        return PDF::loadView('Ecommerce.comprobante', $data)
            ->stream('comprobantePaquete.pdf');
    }
    public function download()
    {
        $data = [
            'titulo' => 'Styde.net'
        ];
        //return 1;
      //  return PDF::loadHTML('Ecommerce\comprobante')
        //    ->stream('archivo.pdf');
    $pdf = PDF::loadView('Ecommerce\comprobante', $data)
    ->setPaper('a4', 'landscape');
      //  return $pdf->download('archivo.pdf');
        $pdf->save('archivo.pdf');
        return back(); 
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\historialPedido  $historialPedido
     * @return \Illuminate\Http\Response
     */
    public function show(historialPedido $historialPedido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\historialPedido  $historialPedido
     * @return \Illuminate\Http\Response
     */
    public function edit(historialPedido $historialPedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\historialPedido  $historialPedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, historialPedido $historialPedido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\historialPedido  $historialPedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(historialPedido $historialPedido)
    {
        //
    }
}
