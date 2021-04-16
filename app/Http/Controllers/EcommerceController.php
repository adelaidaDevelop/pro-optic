<?php

namespace App\Http\Controllers;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\Detalle_venta;
use Illuminate\Http\Request;
use DateInterval;

use Validator, Hash, Auth;
class EcommerceController extends Controller
{
    public function __construct()
    {
        //return 'Entra aqui';
        //$this->middleware('isEmpleado');
        
    }
    public function index()
    {
        //$this->middleware('isCliente');
        //return 'Esta entrando x2';
        //return Producto::all()[0];
        $productos = [];//Producto::all();
        $productosNuevos = $this->productosNuevos();
        $productosDestacados = $this->productosDestacados();
        return view('Ecommerce.index',compact('productos','productosNuevos','productosDestacados'));
        //return session('idCliente');
        //return session('idEmpleado');
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
        //$cantidades = [];
        //$pos = array_column($ventas, 'id');
        //$p = array_search(11, $pos);
        //if($p == NULL)
          //  return 'No econtrado';
        
        foreach($ventas as $venta)
        {
            $detalle_ventas = Detalle_venta::where('idVenta','=',$venta->id)->get(['idProducto','cantidad']);
            foreach($detalle_ventas as $dv)
            {
                $ids = array_column($productos, 'id');
                $pos = array_search($dv->idProducto, $ids);
                if($pos != NULL)
                {
                    $productos[$pos]->cantidad = $productos[$pos]->cantidad + $dv->cantidad;
                    //array_search($dv->cantidad, $productos);
                }else
                {
                    $producto = [];
                    $producto['id'] = $dv->idProducto;
                    $producto['cantidad'] = $dv->cantidad;
                    array_push($productos,$producto);
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
        if(Auth::check())
        {
            
        }
        //return 'Si existe el carrito';
        $carrito =  session('carrito');
        if(isset($carrito))
        {
            $producto = Producto::findOrFail($id);
            array_push($carrito,$producto);
            session(['carrito' => $carrito]);
            return $carrito;//'Si existe el carrito';
        }
        else{
            $carrito = [];
            $producto = Producto::findOrFail($id);
            array_push($carrito,$producto);
            session(['carrito' => $carrito]);
            return $carrito;//'No existe el carrito';
        }
        

    }
}
