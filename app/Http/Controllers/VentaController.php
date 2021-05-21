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
use App\Models\venta_cliente;
use App\Models\Subproducto;
use App\Models\Oferta;
//imp directo
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
//use CapabilityProfile;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

use Exception;

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
         $productosSucursal = Sucursal_producto::where('idSucursal', '=',$idSucursal)->where('status', '=',1)->get();
        return view('Venta.index', compact('datosP', 'departamentos', 'clientes','productosSucursal', 'subproductos','ofertas'));
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
            
            $cliente = $request->input('cliente');
            $venta = Venta::create([
                'tipo' => $estado,
                'status' => true,
                'idSucursalEmpleado' => $idSucursalEmpleado,//session('idSucursalEmpleado'),
            ]);
            
            $credito = new Venta_cliente; //credito
            $credito->estado = 'incompleto';
            $credito->idCliente = $cliente;
            $credito->idVenta = $venta->id;
            $credito->save();
            
            if($pago > 0){
                
            $pagoCredito = new Pago_venta;
            $pagoCredito->idVentaCliente = $credito->id;
            $pagoCredito->idEmpSuc = $idSucursalEmpleado;
            $pagoCredito->monto = $pago;
            
            $pagoCredito->save();
            //return 'Todo bien hasta aqui';
            }

        } else {
            // session('idSucursalEmpleado');
            $venta = Venta::create([
               // 'estado' => $estado,
                'tipo' => $estado,
                'idSucursalEmpleado' => $idSucursalEmpleado,//session('idSucursalEmpleado'),
                'pago' => $pago,
                'status' => true,
            ]);
        }
        foreach ($datosCodificados as $datosProducto) {
            //return $datosProducto;
            $producto = new Detalle_venta;
            $producto->cantidad = $datosProducto['cantidad'];
            $producto->idProducto = $datosProducto['idProducto'];
            $producto->precioIndividual= $datosProducto['precio'];
            
            if($datosProducto['tipo'] == 0)
                $tipo = 'NORMAL';
            if($datosProducto['tipo'] == 1)
                $tipo = 'SUBPRODUCTO';
            if($datosProducto['tipo'] == 2)
                $tipo = 'OFERTA';
            $producto->tipo= $tipo;
            //$producto->subtotal = $datosProducto['subtotal'];
            $producto->idVenta = $venta->id;
            $producto->save();
            //return 'Si llega hasta aqui';
            $tipo =  $datosProducto['tipo'];
            if($tipo == 0)
            {
                $productosSucursal = Sucursal_producto::where('idProducto','=',$datosProducto['idProducto'])
                ->where('idSucursal','=',session('sucursal'));//->update(['existencia'=>'11']);
                $existencia = $productosSucursal->first()->existencia - $datosProducto['cantidad'];
                $productosSucursal->update(['existencia'=> $existencia]);
            }
            if($tipo == 1)
            {
                $productosSucursal = Sucursal_producto::where('idProducto','=',$datosProducto['idProducto'])
                ->where('idSucursal','=',session('sucursal'))->get()->first();//->update(['existencia'=>'11']);
                $subproducto = Subproducto::where('idSucursalProducto','=',$productosSucursal->id);
                $existencia = $subproducto->first()->existencia - $datosProducto['cantidad'];
                $subproducto->update(['existencia'=> $existencia]);
            }
            if($tipo == 2)
            {
                $productosSucursal = Sucursal_producto::where('idProducto','=',$datosProducto['idProducto'])
                ->where('idSucursal','=',session('sucursal'))->get()->first();//->update(['existencia'=>'11']);
                $oferta = Oferta::where('idSucursalProducto','=',$productosSucursal->id);
                $existencia = $oferta->first()->existencia - $datosProducto['cantidad'];
                $oferta->update(['existencia'=> $existencia]);
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
    public function show($folio)//Venta $venta)
    {
        $venta= Venta::findOrFail($folio);
        $sE = Sucursal_empleado::findOrFail($venta->idSucursalEmpleado);
        $e = Empleado::findOrFail($sE->idEmpleado);

        if($e->id == 1)
            $cajero =  "ADMINISTRADOR DE LA TIENDA";
        else
            $cajero = $e->primerNombre ." " . $e->segundoNombre." " . $e->apellidoPaterno." " . $e->apellidoMaterno;
        //return $nombre;
        $detalleVenta = Detalle_venta::where('idVenta','=',$folio)->get(['cantidad','precioIndividual']);
        $pago = $venta->pago;
        /*$total = 0;
        foreach($detalleVenta as $dV)
        {
            $total = $total + $dV->
        }*/
        return view('Venta.ticket', compact('cajero','folio','pago'));
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
    public function printVenta(){
        try{
            
   // $profile = CapabilityProfile::load("simple");
    
    //$conector = new WindowsPrintConnector("smb://user:pass@maquina1/epson_tm34");
    $conector = new WindowsPrintConnector("smb://hzhm1:1997@DESKTOP-PNF6KCF/EC-PM-5890X");
    //$conector = new WindowsPrintConnector("smb://hzhm1:1997@LAPTOPADE/Brother_DCP-T510W1");
    //adelaida.molinar1997@gmail.com:Adelaida_97
    $print = new Printer($conector, $profile);
   // $connector = new FilePrintConnector("php://stdout");
    //$printer = new Printer($connector);
    $print -> text("Hello World!\n");
    $print -> cut();
    $print->close();

   // $printer -> text("Hello World!\n");
    //$printer -> cut();
   // $printer->close();
    return true;
        }catch(Exception $e){
           // return $e->getMessage();
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
    }
    public function imprimirPrueba(){
        //
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

    /*public function productos(Request $request)
    {
        //return view('Venta.formulario');
        $datos = $request->input('datos');
        $no = $request->input('no');
        return $datos; //compact($datos);//compact('no');
    }*/
}