<?php

namespace App\Http\Controllers;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\Sucursal;
use App\Models\Sucursal_producto;
use App\Models\Departamento;
use App\Models\Detalle_venta;
use App\Models\Favorito;
use App\Models\Cliente;
use App\Models\Domicilio;
use Illuminate\Http\Request;
use DateInterval;

use Validator, Hash, Auth;
use Illuminate\Support\Facades\DB;
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
        
        $productosNuevos = $this->productosNuevos();
        $productosDestacados = $this->productosDestacados();
        $sucursales = Sucursal::all();
        $departamentos = Departamento::where('ecommerce', '=',1)->get(['id','nombre']);
        //if(isset($this->departamentosFavoritos()))
        $categorias = $this->departamentosFavoritos();
        //return view('Ecommerce.pruebas',compact('productosNuevos','productosDestacados',
        //'sucursales','departamentos','categorias'));
        return view('Ecommerce.index',compact('productosNuevos','productosDestacados',
        'sucursales','departamentos','categorias'));

        //return session('idCliente');
        //return session('idEmpleado');
    }

    public function buscarProducto($producto)
    {
        //return $producto;
        $datos = DB::table('productos')
            ->join('sucursal_productos', 'productos.id', '=', 'sucursal_productos.idProducto')
            ->where([['productos.nombre','like','%'.$producto.'%'],
                ['sucursal_productos.idSucursal','=',session('sucursalEcommerce')]])
            ->orWhere([['sucursal_productos.idSucursal','=',session('sucursalEcommerce')],
                ['productos.descripcion','like','%'.$producto.'%']])
        ->select('*')->limit(30)->get();
            //->groupBy('sucursal_empleados.idSucursal')
        
        $array = json_decode(json_encode($datos), true);
        //$productosNuevos = $this->productosNuevos();
        //$productosDestacados = $this->productosDestacados();
        $sucursales = Sucursal::all();
        $departamentos = Departamento::where('ecommerce', '=',1)->get(['id','nombre']);
        $total = count($array);
        return view('Ecommerce.busqueda',compact('array','total','producto','sucursales','departamentos'));
        //return Producto::join(Producto::)where('nombre','like','%'.$producto.'%')->orWhere('descripcion','like','%'.$producto.'%')
        //->get();

    }
    public function verProducto($id)
    {
        $sucursales = Sucursal::all();
        $departamentos = Departamento::where('ecommerce', '=',1)->get(['id','nombre']);
        $producto = Producto::findOrFail($id);
        $productoSucursal = Sucursal_producto::where('idSucursal', '=',session('sucursalEcommerce'))
        ->where('idProducto','=',$id)->first();
        if(isset($productoSucursal))
        {
            $producto->precio = $productoSucursal->precio;
            $producto->existencia = $productoSucursal->existencia;
        }
        else
        {
            $producto = false;
        }
        return view('Ecommerce.producto',compact('sucursales','departamentos','producto'));
    }

    public function categoria($id)
    {
        $datos = DB::table('sucursal_productos')
            ->join('productos', 'sucursal_productos.idProducto', '=', 'productos.id')
            ->join('departamentos', 'productos.idDepartamento', '=', 'departamentos.id')
            ->where([['sucursal_productos.idSucursal','=',session('sucursalEcommerce')],
                ['productos.idDepartamento','=',$id],['departamentos.ecommerce','=',true]])
        ->select('productos.*','sucursal_productos.*')->limit(30)->get();
            //->groupBy('sucursal_empleados.idSucursal')
        
        $array = json_decode(json_encode($datos), true);
        $sucursales = Sucursal::all();
        $departamentos = Departamento::where('ecommerce', '=',1)->get(['id','nombre']);
        $nombre = Departamento::where('ecommerce', '=',1)->where('id','=',$id)->first()->nombre;
        
        return view('Ecommerce.departamento',compact('array','nombre','sucursales','departamentos'));
        
        //return $array;
    }
    public function departamentosFavoritos()
    {
        $departamentos = Departamento::where('ecommerce','=',true);
        /*$favoritos = Favorito::with([
            'idDepartamento',
            'cantidad',
        ])->orderBy('cantidad','=');*/
        $productoDepartamentos  =[];
        if(isset($departamentos))
        {
            foreach($departamentos->get() as $departamento)
            {
                
                $productos = Producto::where('idDepartamento', '=',$departamento->id)
                ->get(['id','nombre','descripcion','idDepartamento','codigoBarras', 'imagen','receta']);
                if(isset($productos))
                {
                    
                    $i = 0;
                    $total = 0;
                    while($total<5 && $i<count($productos))
                    {
                        //return "Todo bien hasta ahora";
                        $productoSucursal = Sucursal_producto::where('idProducto','=',$productos[$i]->id)
                        ->where('idSucursal','=',session('sucursalEcommerce'))->first();
                        if(isset($productoSucursal) && $productoSucursal->existencia>0)
                        {
                            $productos[$i]['precio'] = $productoSucursal->precio;
                            $productos[$i]['existencia'] = $productoSucursal->precio;
                            if(!isset($productoDepartamentos[$departamento->nombre]))
                            $productoDepartamentos[$departamento->nombre] = [];
                            array_push($productoDepartamentos[$departamento->nombre],$productos[$i]);
                            $total++;
                        }
                        $i++;
                        //$productoDepartamentos[$departamento->nombre] = $productos->take(10)->get(['id','nombre','descripcion','idDepartamento','codigoBarras', 'imagen','receta']);
                    }
                    //$productosSucursal = Sucursal_producto::where('idProducto','=',$datosProducto['idProducto']);
                    //array_push($productoDepartamentos,$productos->take(10)->get(['id','nombre','descripcion','idDepartamento','codigoBarras', 'imagen','receta']));
                    //$productoDepartamentos[$departamento->nombre] = $productos->take(10)->get(['id','nombre','descripcion','idDepartamento','codigoBarras', 'imagen','receta']);
                }
            }
            return $productoDepartamentos;
            //return 'No hay nada en este departamento';
        }
        else{
            return NULL;//'No hay nada en esta tabla';
        }
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
        $banderas =  [];
        foreach($ventas as $venta)
        {
            $detalle_ventas = Detalle_venta::where('idVenta','=',$venta->id)->get(['idProducto','cantidad']);
            foreach($detalle_ventas as $dv)
            {
                $ids = array_column($productos, 'id');
                $pos = array_search($dv->idProducto, $ids);
                array_push($banderas,$pos);
                if(is_numeric($pos))
                {
                    
                    $productos[$pos]['cantidad'] = $productos[$pos]['cantidad'] + $dv->cantidad;
                    //array_search($dv->cantidad, $productos);
                }else
                {
                    $p = Producto::findOrFail($dv->idProducto);
                    $departamento = Departamento::findOrFail($p->idDepartamento);
                    $productoSucursal = Sucursal_producto::where('idSucursal', '=',session('sucursalEcommerce'))
                    ->where('idProducto','=',$dv->idProducto)->first();
                    if(isset($productoSucursal) && $productoSucursal->existencia>0 && $departamento->ecommerce)
                    {
                        $producto = [];

                        $producto['id'] = $dv->idProducto;
                        $producto['cantidad'] = $dv->cantidad;
                        $producto['precio'] = $productoSucursal->precio;
                        $producto['imagen'] = $p->imagen;
                    array_push($productos,$producto);
                    }
                    
                    //array_push($productos,$dv->idProducto);
                    //array_push($cantidades,$dv->cantidad);
                }
            }
        }
        //return $productos;
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
            $productos[$i]['imagen'] = $producto->imagen;
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
            
            //$producto = Producto::findOrFail($id);
            $producto = [];
            $p = Producto::findOrFail($id);
            $sp = Sucursal_producto::where('idSucursal', '=',session('sucursalEcommerce'))
            ->where('idProducto','=',$id)->first();
            //$producto['cantidad'] = $cantidad;
            $producto['id'] = $p->id;
            $producto['imagen'] = $p->imagen;
            $producto['nombre'] = $p->nombre;
            $producto['precio'] = $sp->precio;
            $producto['sucursal'] = session('sucursalEcommerce');
            //array_push($carrito,$producto);
            //session(['carrito' => $carrito]);
            //$ids = array_column($carrito, 'id');
            //$pos = array_search($producto['id'], $ids);
            $pos = false;
            
            for($i=0 ;$i<count($carrito);$i++)
            {
                
                if($producto['id'] == $carrito[$i]['id'] && $producto['sucursal'] == $carrito[$i]['sucursal'])
                {
                    $pos = $i;
                }
                
            }
            //return 'Aqui esta bien';
            if($pos === false)
            {
                $producto['cantidad'] = $cantidad;
                array_push($carrito,$producto);
                session(['carrito' => $carrito]);
            }
            else{
                
                $productoSucursal = Sucursal_producto::where('idSucursal', '=',session('sucursalEcommerce'))
                ->where('idProducto','=',$producto['id'])->first();
                
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
            $producto = [];
            $p = Producto::findOrFail($id);
            $sp = Sucursal_producto::where('idSucursal', '=',session('sucursalEcommerce'))
            ->where('idProducto','=',$id)->first();
            $producto['cantidad'] = $cantidad;
            $producto['id'] = $p->id;
            $producto['imagen'] = $p->imagen;
            $producto['nombre'] = $p->nombre;
            $producto['precio'] = $sp->precio;
            $producto['sucursal'] = session('sucursalEcommerce');
            array_push($carrito,$producto);
            session(['carrito' => $carrito]);
            return $carrito;//'No existe el carrito';
        }
        
    }
    public function cambiarSucursal($sucursal)
    {
        session(['sucursalEcommerce'=>$sucursal]);
        return json_encode(true);//session('sucursalEcommerces');
    }
    public function carrito()
    {
        $sucursales = Sucursal::all();
        $departamentos = Departamento::where('ecommerce', '=',1)->get(['id','nombre']);
        //$producto = Producto::findOrFail($id);
        //$productoSucursal = Sucursal_producto::where('idSucursal', '=',session('sucursalEcommerce'))
        //->where('idProducto','=',$id)->first();
        
        return view('Ecommerce.carrito',compact('sucursales','departamentos'));
        //session(['sucursalEcommerce'=>$sucursal]);
        //return json_encode(true);//session('sucursalEcommerces');
    }
    public function actualizarCantidadCarrito(Request $request, $id)
    {
        //return 'Todo bien';
        $carrito =  session('carrito');
        
        //for($i=0 ;$i<count($carrito);$i++)
        $i=0;
        $pos = true;
        while($i<count($carrito) && $pos)
        {
            
            if($id == $carrito[$i]['id'] && session('sucursalEcommerce') == $carrito[$i]['sucursal'])
            {
                $productoSucursal = Sucursal_producto::where('idSucursal', '=',session('sucursalEcommerce'))
                ->where('idProducto','=',$id)->first();
                //$nuevaCantidad = $carrito[$i]['cantidad'] + $request['cantidad'];
                if($request['cantidad'] <= $productoSucursal->existencia)
                    $carrito[$i]['cantidad'] = $request['cantidad'];
                else
                    return $carrito[$i]['cantidad'];
                
                $pos = true;
            }
            $i++;
        }
        session(['carrito' => $carrito]);
        return $carrito;
    }

    public function pagoPaypal(){
        return view('Ecommerce.pruebaPago');
    }

    public function postDireccion(Request $request)
    {
        //return $request->all();
        $datosDomicilio = $request->except('_token');
        $domicilio = new Domicilio;
        $domicilio->idCliente = Cliente::where('idUsuario','=',session('idCliente'))->first()->id;
        $domicilio->calle = $request['calle'];
        $domicilio->numeroExterior = $request['numeroExterior'];
        $domicilio->numeroInterior = $request['numeroInterior'];
        $domicilio->codigoPostal = $request['codigoPostal'];
        $domicilio->colonia = $request['colonia'];
        $domicilio->save();
        session(['domicilio' => true]);
        return redirect('/direccionEnvio');
    }

    public function eliminarDireccion(Request $request)
    {
        $id =  Auth::user()->id;
        $cliente = Cliente::where('idUsuario','=',$id)->first();
        Domicilio::where('idCliente','=',$cliente->id)->delete();
        return back();
    }

    public function direccionEnvio()
    {
        if(session()->has('carrito'))
        {
            if(!session()->has('idCliente'))
                return redirect('/loginCliente?compra=1');
            $carrito = session('carrito');
            $ss = array_column($carrito, 'sucursal');
            $pos = array_search(session('sucursalEcommerce'), $ss);
            if($pos!==false)
            {
                $id =  Auth::user()->id;
                $cliente = Cliente::where('idUsuario','=',$id)->first();
                $domicilio = Domicilio::where('idCliente','=',$cliente->id)->first();
                $nombre = $cliente->nombre;
                $telefono = $cliente->telefono;
                if(isset($domicilio))
                {
                    if(isset($_GET['domicilio']) && $_GET['domicilio'] == 'false')
                    {
                        session(['domicilio' => false]);
                        return view('Ecommerce.domicilio',compact('domicilio'));
                    }
                    if(session()->has('domicilio') && session('domicilio'))
                    {
                        return view('Ecommerce.detalleCompra',compact('carrito','nombre','domicilio','telefono'));
                    }
                    
                }
                return view('Ecommerce.domicilio');
            }
        }
        return redirect('/carrito');
    }

    public function formaPago()
    {
        return view('Ecommerce.formaPago');
    }
    
    public function revisionPedido()
    {
        return view('Ecommerce.revisionPedido');
    }
}