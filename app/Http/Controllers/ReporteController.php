<?php

namespace App\Http\Controllers;

use App\Models\Reporte;
use App\Models\Venta;
use App\Models\Pago_venta;
use App\Models\Devolucion;
use App\Models\Pago_compra;
use App\Models\Compra;
use App\Models\Empleado;
use App\Models\Producto;
use App\Models\Departamento;
use App\Models\Detalle_compra;
use App\Models\Detalle_venta;
use App\Models\Proveedor;
use App\Models\Sucursal;
use App\Models\Sucursal_empleado;
use App\Models\Sucursal_producto;
use App\Models\venta_cliente;
use App\Models\historialInventario;
use Illuminate\Http\Request;
//use PDF;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;

class ReporteController extends Controller
{
    public function __construct()
    {
        //$usuarios = ['admin',];//,'admin'];
        //Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function encabezadoPag(Request $request){
        $datos = $request->input('datos');
        $div = json_decode($datos, true);
     //  return $datosCodificados;
        return  compact('div');
      //  return view('encabezado_pie', compact('div'));
       return view('encabezado_pie', compact('datos'));
    }
    public function index()
    {
        $usuarios = ['verCorte','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        //CORTE DE CAJA INDEX
        $ventas = Venta::all(['id','tipo','pago','status','idSucursalEmpleado','created_at','updated_at']);
        $pagos = Pago_venta::all(['idVentaCliente','idEmpSuc', 'monto','created_at','updated_at']);
        $pagoCompras = Pago_compra::all(['idCompra','monto','idEmpSuc','created_at','updated_at']);
      //  $pagoCompras2 = DB::table('Pago_compra')
       //     ->join('Sucursal_empleado', 'Pago_compra.idEmpSuc', '=', 'Sucursal_empleado.id')
        //    ->where('Sucursal_empleado.idSucursal','=', $idSucursal)
          //  ->get();
            //return $pagoCompras2;
      
        $venta_cliente = venta_cliente::all(['id','estado','idCliente','idVenta','created_at','updated_at']);
        $devoluciones = Devolucion::all(['idEmpSuc','idVenta','idProducto','precio','cantidad','observacion','created_at','updated_at']);
       // $pagoCompras= Pago_compra::all();
        $compras = Compra::all();
        $empleados = Empleado::all();
        $productos = Producto::all(['id','codigoBarras', 'nombre','descripcion','receta' ,'idDepartamento','imagen']);
        $detalleV = Detalle_venta::all();
        $idSucursal = session('sucursal');
        $departamento = Departamento::all(['id','nombre']);
        $suc_prod = Sucursal_producto::where('idSucursal', '=', $idSucursal)
        ->get(['id','costo','precio','existencia','minimoStock','idProducto','status']);
        //Seleccionar empleados que son cajeros
        
        $suc_act = Sucursal::findOrFail($idSucursal)->get(['direccion','telefono','status']);
        $sucursalEmpleados = Sucursal_empleado::where('idSucursal', '=', $idSucursal)->get(['id','idSucursal','idEmpleado','status','created_at','updated_at']);
        //return $sucursalEmpleados;
        return view('Reportes.corteCaja', compact('empleados','ventas', 'pagos', 'devoluciones','pagoCompras','compras','sucursalEmpleados','suc_act','detalleV', 'productos', 'suc_prod','venta_cliente','departamento'));
    }
    public function corte_cajaView(){
        $idSucursal = session('sucursal');
        $suc_act = Sucursal::findOrFail($idSucursal)->first(['direccion','telefono','status']);
        return view('Reportes.formato_corteCaja', compact('suc_act'));
    }

    public function index2()
    {
        //REPORTE INVENTARIO INDEX
        $usuarios = ['verReporte','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        
        $empleados = Empleado::all(['id','primerNombre','segundoNombre','apellidoPaterno','apellidoMaterno','genero']);
        $idSucursal = session('sucursal');
        $sucursalEmpleados = Sucursal_empleado::where('idSucursal', '=', $idSucursal)
        ->get(['id','idEmpleado','status']);

        $compras= Compra::all();
        $detalleCompra= Detalle_compra::all();
        $productos= Producto::all(['id','codigoBarras', 'nombre','descripcion','receta' ,'idDepartamento','created_at','updated_at']);
        $devoluciones= Devolucion::all();
        $departamentos= Departamento::all(['id','nombre']);
        $ventas = Venta::all(['id','tipo','pago','status','idSucursalEmpleado','created_at','updated_at']);
        $detalle_ventas = Detalle_venta::all();
        $sucursal_productos = Sucursal_producto::where('idSucursal','=', $idSucursal)
        ->get(['id','costo','precio', 'existencia','minimoStock','status','idSucursal','idProducto']);
        return view('Reportes.reporteInventario', compact('empleados','compras','detalleCompra', 'productos','devoluciones', 'departamentos','ventas', 'detalle_ventas', 'sucursal_productos', 'sucursalEmpleados'));
    }
    public function index3()
    {
        $empleados = Empleado::all();
        $idSucursal = session('sucursal');
        $sucursalEmpleados = Sucursal_empleado::where('idSucursal', '=', $idSucursal)->get();
        $productos= Producto::all();
        $departamentos= Departamento::all();
        $ventas = Venta::all();
        $detalle_ventas = Detalle_venta::all();
        $sucursal_productos = Sucursal_producto::where('idSucursal','=', $idSucursal)->get();
        return view('Reportes.reporteVentas', compact('empleados','sucursalEmpleados','productos','departamentos','ventas','detalle_ventas', 'sucursal_productos'));
    }

    public function index4()
    {
        $usuarios = ['verReporte','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        
        $empleados = Empleado::all();
        $idSucursal = session('sucursal');
        $sucursalEmpleados = Sucursal_empleado::where('idSucursal', '=', $idSucursal)->get();
        $compras= Compra::all();
        $detalleCompra= Detalle_compra::all();
        $productos= Producto::all();
        $devoluciones= Devolucion::all();
        $departamentos= Departamento::all();
        $ventas = Venta::all();

        $comprasFiltro = [];
        foreach($compras as $c)
        {
            $bandera = true;
            foreach($sucursalEmpleados as $suc_emp)
            {
                if($suc_emp->id == $c->idSucursalEmpleado){
                    array_push($comprasFiltro,$c);
                }
            }
        }

        $ventasFiltro = [];
        foreach($ventas as $v)
        {
           // $bandera = true;
            foreach($sucursalEmpleados as $suc_emp)
            {
                if($suc_emp->id == $v->idSucursalEmpleado){
                    array_push($ventasFiltro,$v);
                }
            }
        }
        $hoy = now()->toDateString();
        $ayer = date("d-m-Y",strtotime($hoy."- 1 days")); 
       // return $ayer;
        $proveedores = Proveedor::where('status','=', 1)->get(['id','nombre']);
        $detalle_ventas = Detalle_venta::all();
        $sucursal_productos = Sucursal_producto::where('idSucursal','=', $idSucursal)->get();
        $totalInventario = historialInventario::where('idSucursal','=', $idSucursal)->where('fecha','=', $ayer)
        ->select('totalInv')->get();
        return view('Reportes.entradas_salidas', compact('empleados', 'compras', 'detalleCompra', 'productos', 'devoluciones', 'departamentos', 'ventas', 'detalle_ventas', 'sucursal_productos', 'sucursalEmpleados','proveedores','comprasFiltro','ventasFiltro','totalInventario'));    
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function show(Reporte $reporte)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function edit(Reporte $reporte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reporte $reporte)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reporte $reporte)
    {
        //
    }

    public function histoVenta(){
        $hoy = now()->toDateString();
        $datos = DB::table('detalle_ventas')
            ->join('ventas', 'detalle_ventas.idVenta', '=', 'ventas.id')
            ->join('sucursal_empleados', 'ventas.idSucursalEmpleado', '=', 'sucursal_empleados.id')
            ->where('ventas.fecha', '=', $hoy)
            ->select('sucursal_empleados.idSucursal as idSucu',  DB::raw('SUM(detalle_ventas.precioIndividual * detalle_ventas.cantidad) as sumaT'))
            ->groupBy('sucursal_empleados.idSucursal')
    ->get();
        //return $datos;
       // $array = (array) $datos;
        $array = json_decode(json_encode($datos), true);
    //return $array;
    foreach ($array as $datosInsertar) {
      //  return $datosInsertar;
      $historialV = new historialInventario;
      $historialV->totalInv = $datosInsertar['sumaT'];
      $historialV->fecha = $hoy;
      $historialV->idSucursal = $datosInsertar['idSucu'];
      $historialV->save();
        }
        return true;
    }

    function pdf() {
        $ventas = Venta::all();
        $pagos = Pago_venta::all();
        $devoluciones = Devolucion::all();
        $pagoCompras= Pago_compra::all();
        $compras = Compra::all();
        $empleados = Empleado::all();
        //Seleccionar empleados que son cajeros
        $idSucursal = session('sucursal');
        $sucursalEmpleados = Sucursal_empleado::where('idSucursal', '=', $idSucursal)->get();
        //return $sucursalEmpleados;
      //  return view('Reportes.corteCaja', compact('empleados','ventas', 'pagos', 'devoluciones','pagoCompras','compras','sucursalEmpleados'));

     //  $datos = compact('empleados','ventas', 'pagos', 'devoluciones','pagoCompras','compras','sucursalEmpleados');
       
       $data = [
            'empleados' => $empleados,
            'ventas' => $ventas,
            'pagos' => $pagos,
            'devoluciones' => $devoluciones,
            'pagoCompras' => $pagoCompras,
            'compras' =>$compras,
            'sucursalEmpleados' => $sucursalEmpleados
        ];
        
        
        $pdf = PDF::loadHTML('Reportes\corteCaja', $data)
        ->setPaper('a4', 'landscape');
        
        //return $pdf;
        $pdf->save('corteCaja10.pdf');
        return back(); 
    }
/*
    function pdf2(){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->guardar());
       }
    public function guardar()
    {
    $data = [
        'titulo' => 'Styde.net'
    ];

    $pdf = \PDF::loadView('Reportes\corteCaja', $data);

    return $pdf->save('corte_caja.pdf');
    }

    */
}
