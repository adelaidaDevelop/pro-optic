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
use App\Models\Pago_venta;
use App\Models\Sucursal_producto;
use App\Models\Sucursal_empleado;
use App\Models\Empleado;
use App\Models\Venta_cliente;
use App\Models\Subproducto;
use App\Models\Oferta;
use App\Models\Pedido_contra_entrega;
use App\Models\detallePedido_CE;

//imp directo
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
//use CapabilityProfile;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\EscposImage;

use Exception;
use Illuminate\Support\Facades\Date;

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

        //$usuarios = ['crearVenta','admin'];
        //Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  

        $datosP = Producto::all();
        $departamentos = Departamento::all();
        $clientes = Cliente::all();
        //$datos['departamentos'] = Producto::paginate();
        $idSucursal = session('sucursal');
        $subproductos = Subproducto::all();

        $ofertas = Oferta::all();

        //$sucursalProd = Sucursal_producto::where('idSucursal', $idSucursal)->get();
        $productosSucursal = Sucursal_producto::where('idSucursal', '=', $idSucursal)->where('status', '=', 1)->get();
    
        $pedidosContraEntrega = Pedido_contra_entrega::where('idSucursal', '=',session('sucursal'))->get();
        
        $productos = Producto::get();
        $detallePedidos = detallePedido_CE::get();
        return view('Venta.index', compact('datosP', 'departamentos', 'clientes', 'productosSucursal', 'subproductos',
         'ofertas','pedidosContraEntrega','detallePedidos','productos'));
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
        //$usuarios = ['crearVenta','admin'];
        //Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  

        $datos = $request->input('datos');
        $estado = $request->input('estado');
        $pago = $request->input('pago');
        $idSucursalEmpleado = $request->input('idSucursalEmpleado');
        $venta = "";
        $datosCodificados = json_decode($datos, true);

        if ($request->has('cliente')) {
            $hoy = now()->toDateString();
            $cliente = $request->input('cliente');
            $venta = Venta::create([
                'tipo' => $estado,
                'fecha' => $hoy,
                'status' => true,
                'idSucursalEmpleado' => $idSucursalEmpleado, //session('idSucursalEmpleado'),
            ]);

            $credito = new Venta_cliente; //credito
            $credito->estado = 'incompleto';
            $credito->idCliente = $cliente;
            $credito->idVenta = $venta->id;
            $credito->save();

            if ($pago > 0) {

                $pagoCredito = new Pago_venta;
                $pagoCredito->idVentaCliente = $credito->id;
                $pagoCredito->idEmpSuc = $idSucursalEmpleado;
                $pagoCredito->monto = $pago;
                $pagoCredito->save();
                //return 'Todo bien hasta aqui';
            }
        } else {
            // session('idSucursalEmpleado');
            $hoy = now()->toDateString();
            //return $hoy;
            $venta = Venta::create([
                // 'estado' => $estado,
                'tipo' => $estado,
                'idSucursalEmpleado' => $idSucursalEmpleado, //session('idSucursalEmpleado'),
                'pago' => $pago,
                'fecha' => $hoy,
                'status' => true,
            ]);
        }
        foreach ($datosCodificados as $datosProducto) {
            //return $datosProducto;
            $producto = new Detalle_venta;
            $producto->cantidad = $datosProducto['cantidad'];
            $producto->idProducto = $datosProducto['idProducto'];
            $producto->precioIndividual = $datosProducto['precio'];

            if ($datosProducto['tipo'] == 0)
                $tipo = 'NORMAL';
            if ($datosProducto['tipo'] == 1)
                $tipo = 'SUBPRODUCTO';
            if ($datosProducto['tipo'] == 2)
                $tipo = 'OFERTA';
            $producto->tipo = $tipo;
            //$producto->subtotal = $datosProducto['subtotal'];
            $producto->idVenta = $venta->id;
            $producto->save();
            //return 'Si llega hasta aqui';
            $tipo =  $datosProducto['tipo'];
            if ($tipo == 0) {
                $productosSucursal = Sucursal_producto::where('idProducto', '=', $datosProducto['idProducto'])
                    ->where('idSucursal', '=', session('sucursal')); //->update(['existencia'=>'11']);
                $existencia = $productosSucursal->first()->existencia - $datosProducto['cantidad'];
                $productosSucursal->update(['existencia' => $existencia]);
            }
            if ($tipo == 1) {
                $productosSucursal = Sucursal_producto::where('idProducto', '=', $datosProducto['idProducto'])
                    ->where('idSucursal', '=', session('sucursal'))->get()->first(); //->update(['existencia'=>'11']);
                $subproducto = Subproducto::where('idSucursalProducto', '=', $productosSucursal->id);
                $existencia = $subproducto->first()->existencia - $datosProducto['cantidad'];
                $subproducto->update(['existencia' => $existencia]);
            }
            if ($tipo == 2) {
                $productosSucursal = Sucursal_producto::where('idProducto', '=', $datosProducto['idProducto'])
                    ->where('idSucursal', '=', session('sucursal'))->get()->first(); //->update(['existencia'=>'11']);
                $oferta = Oferta::where('idSucursalProducto', '=', $productosSucursal->id);
                $existencia = $oferta->first()->existencia - $datosProducto['cantidad'];
                $oferta->update(['existencia' => $existencia]);
            }
        }
        return $venta->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    /////SHOW2: ORIGINAL
    public function show2($folio) //Venta $venta)
    {
        $venta = Venta::findOrFail($folio);
        $sE = Sucursal_empleado::findOrFail($venta->idSucursalEmpleado);
        $e = Empleado::findOrFail($sE->idEmpleado);

        if ($e->id == 1)
            $cajero =  "ADMINISTRADOR DE LA TIENDA";
        else
            $cajero = $e->primerNombre . " " . $e->segundoNombre . " " . $e->apellidoPaterno . " " . $e->apellidoMaterno;
        //return $nombre;
        $detalleVenta = Detalle_venta::where('idVenta', '=', $folio)->get(['cantidad', 'precioIndividual']);
        $pago = $venta->pago;
        /*$total = 0;
        foreach($detalleVenta as $dV)
        {
            $total = $total + $dV->
        }*/

        return view('Venta.ticket', compact('cajero', 'folio', 'pago'));
    }
    ////
    public function show($folio) //Venta $venta)
    {
      //  return true;
        $venta = Venta::findOrFail($folio);
        $sE = Sucursal_empleado::findOrFail($venta->idSucursalEmpleado);
        $e = Empleado::findOrFail($sE->idEmpleado);

        if ($e->id == 1)
            $cajero =  "ADMINISTRADOR DE LA TIENDA";
        else
            $cajero = $e->primerNombre . " " . $e->segundoNombre . " " . $e->apellidoPaterno . " " . $e->apellidoMaterno;
        //return $nombre;
        $detalleVenta = Detalle_venta::where('idVenta', '=', $folio)->get(['cantidad', 'precioIndividual']);
        $pago = $venta->pago;

        //
        $productos= json_decode($_GET['productos']);
        
        $totalOk = 0;
        foreach ($productos as $p) {
            $subtotal = $p->precio * $p->cantidad;
            $totalOk = $totalOk + $subtotal;
        }
        $cambio = $pago - $totalOk;

        
        //IMPRIRMIR
        $nombreImpresora = "EC-PM-5890X";
        $connector = new WindowsPrintConnector($nombreImpresora);
        //return 'Aqui todo bien';
        $printer = new Printer($connector);

        //contenido imprimir
        //productos de la venta
        $arregloP = null;
        $comprasFiltro = [];
        foreach ($productos as $p) {
            $subtotal2 = $p->precio * $p->cantidad;
            $elemento = new ItemController($p->nombre, $subtotal2);
            array_push($comprasFiltro,$elemento);
        }

        //total y subtotal
        // $subtotal = new item('Subtotal', '12.95');
        // $tax = new item('A local tax', '1.30');
        $total = new ItemController('Total', $totalOk, true);

        $date = now()->format('d-m-Y h:i:s A');

        
        //logo empresa
        
        //$logo = EscposImage::load("img/farmaciagilogo.png", false);

        
        //CArgar logo
        /* Print top logo */
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        //$printer->graphics($logo);
        
        /* Name of shop */
        $nombreSuc = session("sucursalNombre");
       // return $nombreSuc;
        $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        $printer->text("FARMACIAS GI S.A DE C.V.\n");
        $printer->selectPrintMode();
        $printer->text( $nombreSuc, ".\n");
        $printer->feed();
        /* Title of receipt */
        $printer->setEmphasis(true);
        $printer->text("TICKET\n");
        $printer->text($date . "\n");
        $printer->setEmphasis(false);

        

        /* Items */
        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer->setEmphasis(false);
        $printer->text(new ItemController('PRODUCTO', '$'));
        $printer->setEmphasis(false);
        foreach ($comprasFiltro as $item) {
            $printer->text($item);
        }
        

       // $printer->setEmphasis(false);
        //$printer->setEmphasis(true);
      //  $printer->text($subtotal);
      //  $printer->setEmphasis(false);
        $printer->feed();

        
        /* Tax and total */
      //  $printer->text($tax);
        $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        $printer->text($total);
        $printer->selectPrintMode();

        
        /* Footer */
        $printer->feed(2);
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("FARMACIAS GI ZIMATLAN, AGRADECE SU PREFERENCIA.\n");
        $printer->feed(2);
        
        
        /* Cut the receipt and open the cash drawer */
        $printer->cut();
      //  $printer->Pulse();
        $printer->close();

       // return $total;
    return true;
        //        return true;
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
    //metodo imprimir directo 
    public function printVenta()
    {
        try {

            // $profile = CapabilityProfile::load("simple");

            //$conector = new WindowsPrintConnector("smb://user:pass@maquina1/epson_tm34");
            $conector = new WindowsPrintConnector("smb://hzhm1:1997@DESKTOP-PNF6KCF/EC-PM-5890X");
            //$conector = new WindowsPrintConnector("smb://hzhm1:1997@LAPTOPADE/Brother_DCP-T510W1");
            //adelaida.molinar1997@gmail.com:Adelaida_97
         //   $print = new Printer($conector, $profile);
            // $connector = new FilePrintConnector("php://stdout");
            //$printer = new Printer($connector);
          //  $print->text("Hello World!\n");
          //  $print->cut();
          //  $print->close();

            // $printer -> text("Hello World!\n");
            //$printer -> cut();
            // $printer->close();
            return true;
        } catch (Exception $e) {
            // return $e->getMessage();
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
    }
    public function imprimirPrueba2()
    {
        $nombreImpresora = "EC-PM-5890X";
        $connector = new WindowsPrintConnector($nombreImpresora);
        //return 'Aqui todo bien';
        $impresora = new Printer($connector);
        $impresora->setJustification(Printer::JUSTIFY_CENTER);
        $impresora->setTextSize(2, 2);
        /*$texto = ` <!DOCTYPE html>
        <html lang="en">
        
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <link href="{{ asset('css/ticket.css') }}" rel="stylesheet">
        </head>
        
        <body>
        @php
        if(isset($_GET['productos'])){
            $productos= json_decode($_GET['productos']);
        }
        $total = 0;
        foreach($productos as $p)
        {
            $subtotal = $p->precio * $p->cantidad;
            $total = $total + $subtotal;
        }
        $cambio = $pago - $total;
        @endphp
            
        <div class="ticket">
                    <img
                        src="{{ asset('img\farmaciagilogo.png') }}"
                        alt="Logotipo">
                    <p class="centrado">FARMACIAS GI ZIMATLAN
                        <br>{{session('sucursalNombre')}}
                        <br>{{now()->format('d-m-Y h:i:s A')}}
                        <br>CAJERO: {{$cajero}}
                        <br>No. Folio: {{$folio}}</p>
                    <table>
                        <thead>
                            <tr>
                                <th class="cantidad">CANT</th>
                                <th class="producto">PRODUCTO</th>
                                <th class="precio">PRECIO</th>
                                <th class="precio">IMPORTE</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($productos as $producto)
                            <tr>
                                <td class="cantidad">{{$producto->cantidad}}</td>
                                <td class="producto">{{$producto->nombre}}</td>
                                <td class="precio">{{$producto->precio}}</td>
                                <td class="precio">{{$producto->subtotal}}</td>
                            </tr>
                        @endforeach
                            <!--tr>
                                <td class="cantidad">1.00</td>
                                <td class="producto">CHEETOS VERDES 80 G</td>
                                <td class="precio">$8.50</td>
                            </tr>
                            <tr>
                                <td class="cantidad">2.00</td>
                                <td class="producto">KINDER DELICE</td>
                                <td class="precio">$10.00</td>
                            </tr>
                            <tr>
                                <td class="cantidad">1.00</td>
                                <td class="producto">COCA COLA 600 ML</td>
                                <td class="precio">$10.00</td>
                            </tr>
                            <tr>
                                <td class="cantidad"></td>
                                <td class="producto">TOTAL</td>
                                <td class="precio">$28.50</td>
                            </tr-->
                        </tbody>
                    </table>
                    <p class="">TOTAL: ${{$total}}
                        <br>PAGÓ CON: ${{$pago}}
                        <br />SU CAMBIO: ${{$cambio}}</p>
                    <p class="centrado">¡GRACIAS POR SU COMPRA!
                        <br>farmaciasgizimatlan.epizy.com</p>
                </div>
            
        </body>
        
        </html> `;*/
        $impresora->text("");
        $impresora->text("ticket\n");
        $impresora->text("desde\n");
        $impresora->text("Laravel\n");
        $impresora->setTextSize(1, 1);
        $impresora->text("https://parzibyte.me");
        $impresora->feed(5);
        $impresora->close();
        return true;
    }
    public function imprimirPrueba()
    {
        $nombreImpresora = "EC-PM-5890X";
        $connector = new WindowsPrintConnector($nombreImpresora);
        //return 'Aqui todo bien';
        $impresora = new Printer($connector);
        $impresora->setJustification(Printer::JUSTIFY_CENTER);
        $impresora->setTextSize(2, 2);
        $impresora->text("Imprimiendo\n");
        $impresora->text("ticket\n");
        $impresora->text("desde\n");
        $impresora->text("Laravel\n");
        $impresora->setTextSize(1, 1);
        $impresora->text("https://parzibyte.me");
        $impresora->feed(5);
        $impresora->close();
        return true;
    }
    //imprimirTicketAjustado

    public function impAjustado($folio){
    }

    public function quitarProductoPedido(Request $request)
    {
        $producto = detallePedido_CE::where('idPedido','=',$request['idPedido'])
        ->where('idProducto','=',$request['idProducto']);
        $pedido = Pedido_contra_entrega::where('id','=',$request['idPedido']);
        $nuevoSubtotal = $pedido->first()->subtotal - $producto->first()->subtotal;
        $pedido->update(['subtotal' => $nuevoSubtotal]);
        $nuevoTotal = $pedido->first()->subtotal + $pedido->first()->costoEnvio;
        $pedido->update(['total' => $nuevoTotal]);
        $nuevoCambio =$pedido->first()->pagarCon - $pedido->first()->total ;
        $pedido->update(['cambio' => $nuevoCambio]);
        $producto->delete();
        $pedidos = Pedido_contra_entrega::get();
        $detallePedidos = detallePedido_CE::get();
        return compact('pedidos','detallePedidos');
    }
    public function aceptarPedido(Request $request,$id)
    {
        $pedido = Pedido_contra_entrega::find($id);
        $venta = new Venta;
        $venta->tipo ="ecommerce";
        $venta->totalV = $pedido->total;
        $venta->status = true;
        $venta->idSucursalEmpleado = session('idSucursalEmpleado');
        $venta->fecha = now()->toDateString();
        $venta->save();

        $ventaCliente = new Venta_cliente;
        $ventaCliente->estado = "ACEPTADO";
        $ventaCliente->idCliente = $pedido->idCliente;
        $ventaCliente->idVenta = $venta->id;
        $ventaCliente->direccion = $pedido->direccion;
        $ventaCliente->save();
        
        $detallePedido = detallePedido_CE::where('idPedido','=',$id)->get();
        foreach ($detallePedido as $producto)
        {
            $detalleVenta  = new Detalle_venta;
            $detalleVenta->idVenta = $venta->id;
            $detalleVenta->idProducto = $producto->idProducto;
            $detalleVenta->tipo = "NORMAL";
            $detalleVenta->cantidad = $producto->cantidad;
            $detalleVenta->precioIndividual = $producto->precio;
            
            $sucursal_producto = Sucursal_producto::where('idProducto', '=', $producto->idProducto)
            ->where('idSucursal', '=', $pedido->idSucursal); //->update(['existencia'=>'11']);
            if($producto->cantidad > $sucursal_producto->first()->existencia)
            {
                
                Detalle_venta::where('idVenta','=',$venta->id)->delete();
                Venta_cliente::where('idVenta','=',$venta->id)->delete();
                Venta::destroy($venta->id);
                return 1;
            }
            
            $existencia = $sucursal_producto->first()->existencia - $producto->cantidad;
            $sucursal_producto->update(['existencia' => $existencia]);
        }
        
        detallePedido_CE::where('idPedido','=',$id)->delete();
        Pedido_contra_entrega::destroy($id);
        $pedidos = Pedido_contra_entrega::get();
        $detallePedidos = detallePedido_CE::get();
        return compact('pedidos','detallePedidos');
    }

    public function rechazarPedido(Request $request,$id)
    {
        detallePedido_CE::where('idPedido','=',$id)->delete();
        Pedido_contra_entrega::destroy($id);
        $pedidos = Pedido_contra_entrega::get();
        $detallePedidos = detallePedido_CE::get();
        return compact('pedidos','detallePedidos');
    }

    public function pedidosTiempoReal(Request $request)
    {
        $pedidos = Pedido_contra_entrega::get();
        $detallePedidos = detallePedido_CE::get();
        return compact('pedidos','detallePedidos');
    }
}