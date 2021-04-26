<?php

namespace App\Http\Controllers;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\Sucursal;
use App\Models\Sucursal_producto;
use App\Models\Departamento;
use App\Models\Detalle_venta;
use Illuminate\Http\Request;
use DateInterval;

use Validator, Hash, Auth;
class EcommerceController extends Controller
{
    public function __construct()
    {
        
        if(!session()->has('sucursalEcommerce'))
        {
            $id = Sucursal::all()->first()->id; 
            session(['sucursalEcommerce' => $id]);
        }
        /*else
        {
            session()->forget('sucursalEcommerce');
            session(['sucursalEcommerce' => 1]);
        }**/
        //return 'Entra aqui';
        //$this->middleware('isEmpleado');
        
    }
    public function index()
    {
        //return $id = Sucursal::all()->first()->id; 
        //$this->middleware('isCliente');
        //return 'Esta entrando x2';
        //return Producto::all()[0];
        $productos = [];//Producto::all();
        $productosNuevos = $this->productosNuevos();
        $productosDestacados = $this->productosDestacados();
        $sucursales = Sucursal::all();
        $departamentos = Departamento::where('ecommerce', '=',1)->get(['id','nombre']);
        return view('Ecommerce.index',compact('productos','productosNuevos','productosDestacados',
        'sucursales','departamentos'));

        //return session('idCliente');
        //return session('idEmpleado');
    }

    public function verProducto($id)
    {
        $sucursales = Sucursal::all();
        $departamentos = Departamento::where('ecommerce', '=',1)->get(['id','nombre']);
        $producto = Producto::findOrFail($id);
        $productoSucursal = Sucursal_producto::where('idSucursal', '=',session('sucursalEcommerce'))
        ->where('idProducto','=',$id)->first();
        
        $producto->precio = $productoSucursal->precio;
        $producto->existencia = $productoSucursal->existencia;
        return view('Ecommerce.producto',compact('sucursales','departamentos','producto'));
    }
    public function productosNuevos()
    {
        //Producto::where('id','=',1)->update(['created_at' => now()]);
        $fecha = now()->sub(new DateInterval('P15D'));//->toDateString();
        $productos = Producto::where('created_at','>=',$fecha)->paginate(30,['codigoBarras','nombre','created_at'])->all();
        
        if(count($productos)>=10)
            return $productos;
        else
            return [];//$productos = Producto::where("created_at",'=',now()->toDateString());
    }
    
    public function cmp($a, $b)
    {
        if ($a['cantidad'] == $b['cantidad']) {
            return 0;
        }
        return ($a['cantidad'] < $b['cantidad']) ? -1 : 1;
    }

    public function productosDestacados()
    {
        $fecha = now()->sub(new DateInterval('P1M'));//->toDateString();
        $ventas = Venta::where('created_at','>=',$fecha)->paginate(30,['id','tipo','created_at'])->all();
        $productos = [];
        foreach($ventas as $venta)
        {
            $detalle_ventas = Detalle_venta::where('idVenta','=',$venta->id)->get(['idProducto','cantidad']);
            foreach($detalle_ventas as $dv)
            {
                $ids = array_column($productos, 'id');
                $pos = array_search($dv->idProducto, $ids);
                if($pos != NULL)
                {
                    $productos[$pos]['cantidad'] = $productos[$pos]['cantidad'] + $dv->cantidad;
                    //array_search($dv->cantidad, $productos);
                }else
                {
                    $productoSucursal = Sucursal_producto::where('idSucursal', '=',session('sucursalEcommerce'))
                    ->where('idProducto','=',$dv->idProducto)->first();
                    if($productoSucursal->existencia>0)
                    {
                        $producto = [];

                    $producto['id'] = $dv->idProducto;
                    $producto['cantidad'] = $dv->cantidad;
                    array_push($productos,$producto);
                    }
                    
                    //array_push($productos,$dv->idProducto);
                    //array_push($cantidades,$dv->cantidad);
                }
            }
        }
        
        if(usort($productos,function($a,$b) {
            if ($a['cantidad'] == $b['cantidad']) {
                return 0;
            }
            return ($a['cantidad'] > $b['cantidad']) ? -1 : 1;
        }))
        //return $productos;
        for($i=0;$i<count($productos);$i++)
        {
            $producto = Producto::findOrFail($productos[$i]['id']);
            
            $productos[$i]['nombre'] = $producto->nombre;
            $productos[$i]['descripcion'] = $producto->descripcion;
        }
        return $productos;
        
    }

    public function addCarrito(Request $request, $id)
    {
        //return $id;//'Si existe el carrito';
        $cantidad = 1;
        if($request->has('cantidad'))
        {
            $cantidad = $request['cantidad'];
        }
        if(Auth::check())
        {
            
        }
        //return 'Si existe el carrito';
        $carrito =  session('carrito');
        if(isset($carrito))
        {
            $producto = Producto::findOrFail($id);
            $ids = array_column($carrito, 'id');
            $pos = array_search($producto->id, $ids);
            //return json_encode($pos);
            if($pos === false)
            {
                $producto['cantidad'] = $cantidad;
                array_push($carrito,$producto);
                session(['carrito' => $carrito]);
            }
            else{
                $productoSucursal = Sucursal_producto::where('idSucursal', '=',session('sucursalEcommerce'))
                ->where('idProducto','=',$producto->id)->first();
                $nuevaCantidad = $carrito[$pos]['cantidad'] + $cantidad;
                if($nuevaCantidad <= $productoSucursal->existencia)
                {
                    $carrito[$pos]['cantidad'] = $nuevaCantidad;
                    session(['carrito' => $carrito]);
                }
                else 
                {
                    return 1;
                }
                //return 'Si existe el carrito';
            }
            return $carrito;
        }
        else{
            $carrito = [];
            $producto = Producto::findOrFail($id);
            $producto['cantidad'] = $cantidad;
            array_push($carrito,$producto);
            session(['carrito' => $carrito]);
            return $carrito;//'No existe el carrito';
        }
        

    }
}
