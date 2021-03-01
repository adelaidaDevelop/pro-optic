<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Detalle_compra;
use App\Models\Producto;
use App\Models\Productos_caducidad;
use App\Models\Departamento;
use App\Models\Proveedor;
use App\Models\Pago_compra;
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
        $compras = Compra::all();
        $depas['d']= Departamento::paginate();
        $proveedores= Proveedor::all();
        $productos= Producto::all();
        $compra_producto = Detalle_compra::all();
        return view('Compra.index',$depas, compact('productos','proveedores','compra_producto','compras'));
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
        $proveedores = Proveedor::where('status', '=', true)->get();
        return view('Compra.create', compact('productos','departamentos','proveedores'));
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
        $estado = $request->input('estado');
        $fecha_compra = $request->input('fecha_compra');
        $iva = $request->input('iva');
        $datosCodificados = json_decode($datos,true);
        $compra = Compra::create([
            'idProveedor' => $proveedor,
            'fecha_compra' => $fecha_compra,
            'idSucursalEmpleado' => session('idSucursalEmpleado'),
            'estado' =>$estado,
            'IVA' => $iva,
        ]);
        if($estado =='credito')
        {
            $pagoCompra = $request->input('pago');
            if($pagoCompra>0)
            {
                $pago = new Pago_compra;
                $pago->monto = $pagoCompra;
                $pago->idCompra = $compra->id;
                $pago->save();
            }
            
        }
        return 'Todo bien';
        foreach($datosCodificados as $datosProducto)
        {
            $producto = new Detalle_compra;
            $producto->idCompra = $compra->id;
            $producto->idProducto = $datosProducto['id'];
            $producto->cantidad = $datosProducto['cantidad'];
            $producto->porcentaje_ganancia = $datosProducto['ganancia'];
            //$producto->fecha_caducidad = $datosProducto['caducidad'];
            $producto->costo_unitario = $datosProducto['costo'];
            //$producto->iva = 'Si';
            //$producto->fecha_caducidad = Carbon::createFromFormat( 'Y/m/d', $datosProducto['caducidad']);
            $producto->save();
            
        }

        return true;//view('Venta.index',compact('datosP'));
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function show($compra)
    {
        if($compra=="compras")
        {
            $compras = Compra::all();
            //$productosCodificados = json_encode($productos);
            return $compras;//compact('productos');
        }
        /*else{
            $id = Compra::where("nombre",'like',$request->nombre)->get();
            return $id;
        }*/
        return 'No hay nada';
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
    public function update($id)//Request $request,$id)//, Compra $compra)
    {
        Compra::where('id','=',$id)->update(['estado' => 'pagado']);
        //$estado = $request->input('estado');
        return $id;//'Obvio que retorno algo :v';
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