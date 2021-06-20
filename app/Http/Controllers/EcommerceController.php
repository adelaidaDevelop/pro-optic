<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Venta;
use App\Models\Venta_cliente;
use App\Models\Sucursal;
use App\Models\Sucursal_producto;
use App\Models\Departamento;
use App\Models\Detalle_venta;
use App\Models\Favorito;
use App\Models\Cliente;
use App\Models\Carrito;
use App\Models\Domicilio;
use App\Models\Pedido_contra_entrega;
use App\Models\detallePedido_CE;
use App\Models\Sucursal_empleado;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DateInterval;

use Hash, Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

use Laravel\Fortify\Fortify;

use Illuminate\Routing\UrlGenerator;

class EcommerceController extends Controller
{
    public function __construct()
    {

        if (!session()->has('sucursalEcommerce')) {
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

    public function administracion()
    {
        $departamentos = DB::table('departamentos')->orderBy('nombre')->get(['id', 'nombre', 'ecommerce']);
            /*$departamentos = Departamento::with(['nombre' => function($query)
        {
            $query->orderBy('nombre');
        }])->get()*/; //all(['nombre','id','ecommerce']);//where('ecommerce','=',true)
        return view('Ecommerce.administracion', compact('departamentos'));
    }

    public function actualizarDepartamentos(Request $request)
    {

        $departamentos = $request->input('departamentos');

        $departamentos = json_decode($departamentos);
        //return $departamentos;
        foreach ($departamentos as $d) {
            //return $d->ecommerce;
            Departamento::where('id', '=', $d->id)->update(['ecommerce' => $d->ecommerce]);
            //return $d->ecommerce;
        }
        return true;
        //return $departamentos;
        //return $departamentos[0]['ecommerce'];
    }
    public function index()
    {

        $productosNuevos = $this->productosNuevos();
        $productosDestacados = $this->productosDestacados();
        $sucursales = Sucursal::all();
        $departamentos = Departamento::where('ecommerce', '=', 1)->get(['id', 'nombre']);
        //if(isset($this->departamentosFavoritos()))
        $categorias = $this->departamentosFavoritos();
        //return view('Ecommerce.pruebas',compact('productosNuevos','productosDestacados',
        //'sucursales','departamentos','categorias'));
        return view('Ecommerce.index', compact(
            'productosNuevos',
            'productosDestacados',
            'sucursales',
            'departamentos',
            'categorias'
        ));

        //return session('idCliente');
        //return session('idEmpleado');
    }

    public function buscarProducto()
    {
        //return isset($_GET['buscar']);
        $array = [];
        if (isset($_GET['buscar']))
            $producto = $_GET['buscar'];
        else {
            return view('Ecommerce.busqueda', compact('array'));
        }
        $datos = DB::table('productos')
            ->join('sucursal_productos', 'productos.id', '=', 'sucursal_productos.idProducto')
            ->where([
                ['productos.nombre', 'like', '%' . $producto . '%'],
                ['sucursal_productos.idSucursal', '=', session('sucursalEcommerce')]
            ])
            ->orWhere([
                ['sucursal_productos.idSucursal', '=', session('sucursalEcommerce')],
                ['productos.descripcion', 'like', '%' . $producto . '%']
            ])
            ->select('*')->limit(30)->get();
        //->groupBy('sucursal_empleados.idSucursal')

        $array = json_decode(json_encode($datos), true);
        //return $array;
        //$productosNuevos = $this->productosNuevos();
        //$productosDestacados = $this->productosDestacados();
        $sucursales = Sucursal::all();
        $departamentos = Departamento::where('ecommerce', '=', 1)->get(['id', 'nombre']);
        $total = count($array);
        return view('Ecommerce.busqueda', compact('array', 'total', 'producto', 'sucursales', 'departamentos'));
        //return Producto::join(Producto::)where('nombre','like','%'.$producto.'%')->orWhere('descripcion','like','%'.$producto.'%')
        //->get();

    }
    public function verProducto($id)
    {
        $sucursales = Sucursal::all();
        $departamentos = Departamento::where('ecommerce', '=', 1)->get(['id', 'nombre']);
        $producto = Producto::findOrFail($id);
        $productoSucursal = Sucursal_producto::where('idSucursal', '=', session('sucursalEcommerce'))
            ->where('idProducto', '=', $id)->first();
        if (isset($productoSucursal)) {
            $producto->precio = $productoSucursal->precio;
            $producto->existencia = $productoSucursal->existencia;
            $carritoAux = session('carrito');
            $departamento = Departamento::findOrFail($producto->idDepartamento)->nombre;
            $producto->departamento = $departamento;
            if (isset($carritoAux) && count($carritoAux) > 0) {
                for ($i = 0; $i < count($carritoAux); $i++) {
                    if (
                        $carritoAux[$i]['sucursal'] == session('sucursalEcommerce') &&
                        $carritoAux[$i]['id'] == $id
                    ) {
                        $producto->existencia = $productoSucursal->existencia - $carritoAux[$i]['cantidad'];
                    }
                }
            }
        } else {
            $producto = false;
        }
        return view('Ecommerce.producto', compact('sucursales', 'departamentos', 'producto'));
    }

    public function categoria($id)
    {
        $datos = DB::table('sucursal_productos')
            ->join('productos', 'sucursal_productos.idProducto', '=', 'productos.id')
            ->join('departamentos', 'productos.idDepartamento', '=', 'departamentos.id')
            ->where([
                ['sucursal_productos.idSucursal', '=', session('sucursalEcommerce')],
                ['productos.idDepartamento', '=', $id], ['departamentos.ecommerce', '=', true]
            ])
            ->select('productos.*', 'sucursal_productos.*')->limit(30)->get();
        //->groupBy('sucursal_empleados.idSucursal')

        $array = json_decode(json_encode($datos), true);
        $sucursales = Sucursal::all();
        $departamentos = Departamento::where('ecommerce', '=', 1)->get(['id', 'nombre']);
        $nombre = Departamento::where('ecommerce', '=', 1)->where('id', '=', $id)->first()->nombre;

        return view('Ecommerce.departamento', compact('array', 'nombre', 'sucursales', 'departamentos'));

        //return $array;
    }
    public function departamentosFavoritos()
    {
        $departamentos = Departamento::where('ecommerce', '=', true);
        /*$favoritos = Favorito::with([
            'idDepartamento',
            'cantidad',
        ])->orderBy('cantidad','=');*/
        $productoDepartamentos  = [];
        if (isset($departamentos)) {
            foreach ($departamentos->get() as $departamento) {

                $productos = Producto::where('idDepartamento', '=', $departamento->id)
                    ->get(['id', 'nombre', 'descripcion', 'idDepartamento', 'codigoBarras', 'imagen', 'receta']);
                if (isset($productos)) {

                    $i = 0;
                    $total = 0;
                    while ($total < 5 && $i < count($productos)) {
                        //return "Todo bien hasta ahora";
                        $productoSucursal = Sucursal_producto::where('idProducto', '=', $productos[$i]->id)
                            ->where('idSucursal', '=', session('sucursalEcommerce'))->first();
                        if (isset($productoSucursal) && $productoSucursal->existencia > 0) {
                            $productos[$i]['precio'] = $productoSucursal->precio;
                            $productos[$i]['existencia'] = $productoSucursal->precio;
                            if (!isset($productoDepartamentos[$departamento->nombre]))
                                $productoDepartamentos[$departamento->nombre] = [];
                            array_push($productoDepartamentos[$departamento->nombre], $productos[$i]);
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
        } else {
            return NULL; //'No hay nada en esta tabla';
        }
    }

    public function productosNuevos()
    {
        //Producto::where('id','=',1)->update(['created_at' => now()]);
        $fecha = now()->sub(new DateInterval('P15D')); //->toDateString();
        $productos = Producto::where('created_at', '>=', $fecha)->paginate(30, ['codigoBarras', 'nombre', 'created_at'])->all();

        if (count($productos) >= 10)
            return $productos;
        else
            return []; //$productos = Producto::where("created_at",'=',now()->toDateString());
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
        $fecha = now()->sub(new DateInterval('P1M')); //->toDateString();
        $ventas = Venta::where('created_at', '>=', $fecha)->paginate(30, ['id', 'tipo', 'created_at'])->all();
        $productos = [];
        $banderas =  [];
        foreach ($ventas as $venta) {
            $detalle_ventas = Detalle_venta::where('idVenta', '=', $venta->id)->get(['idProducto', 'cantidad']);
            foreach ($detalle_ventas as $dv) {
                $ids = array_column($productos, 'id');
                $pos = array_search($dv->idProducto, $ids);
                array_push($banderas, $pos);
                if (is_numeric($pos)) {

                    $productos[$pos]['cantidad'] = $productos[$pos]['cantidad'] + $dv->cantidad;
                    //array_search($dv->cantidad, $productos);
                } else {
                    $p = Producto::findOrFail($dv->idProducto);
                    $departamento = Departamento::findOrFail($p->idDepartamento);
                    $productoSucursal = Sucursal_producto::where('idSucursal', '=', session('sucursalEcommerce'))
                        ->where('idProducto', '=', $dv->idProducto)->first();
                    if (isset($productoSucursal) && $productoSucursal->existencia > 0 && $departamento->ecommerce) {
                        $producto = [];

                        $producto['id'] = $dv->idProducto;
                        $producto['cantidad'] = $dv->cantidad;
                        $producto['precio'] = $productoSucursal->precio;
                        $producto['imagen'] = $p->imagen;
                        array_push($productos, $producto);
                    }

                    //array_push($productos,$dv->idProducto);
                    //array_push($cantidades,$dv->cantidad);
                }
            }
        }
        //return $productos;
        if (usort($productos, function ($a, $b) {
            if ($a['cantidad'] == $b['cantidad']) {
                return 0;
            }
            return ($a['cantidad'] > $b['cantidad']) ? -1 : 1;
        }))
            //return $productos;
            for ($i = 0; $i < count($productos); $i++) {
                $producto = Producto::findOrFail($productos[$i]['id']);

                $productos[$i]['nombre'] = $producto->nombre;
                $productos[$i]['descripcion'] = $producto->descripcion;
                $productos[$i]['imagen'] = $producto->imagen;
            }
        return $productos;
    }

    public function addCarrito(Request $request, $id)
    {

        $cantidad = 1;
        $p = Producto::find($id);
        $sp = Sucursal_producto::where('idSucursal', '=', session('sucursalEcommerce'))
            ->where('idProducto', '=', $id)->first();
        if ($sp->existencia == 0) {
            return 2;
        }
        //Revisa si recibe una cantidad de la solicitud
        if ($request->has('cantidad')) {
            $cantidad = $request['cantidad'];
        }
        if (Auth::check()) {
            if (Auth::user()->tipo == 2) {

                $producto = [];
                $producto['id'] = $p->id;
                $producto['imagen'] = $p->imagen;
                $producto['nombre'] = $p->nombre;
                $producto['precio'] = $sp->precio;
                $producto['sucursal'] = session('sucursalEcommerce');
                $carrito = Carrito::where('idUsuario', '=', Auth::user()->id)->where('idProducto', '=', $id)
                    ->where('idSucursal', '=', session('sucursalEcommerce')); //->get();

                if (count($carrito->get()) > 0) {
                    $nuevaCantidad = $cantidad + $carrito->first()->cantidad;
                    if ($nuevaCantidad <= $sp->existencia) {
                        $carrito->update(['cantidad' => $nuevaCantidad]);
                        $carrito = session('carrito');
                        for ($i = 0; $i < count($carrito); $i++) {
                            if ($id == $carrito[$i]['id'] && $producto['sucursal'] == $carrito[$i]['sucursal']) {
                                $carrito[$i]['cantidad'] = $nuevaCantidad;
                            }
                        }
                        session(['carrito' => $carrito]);
                        return $carrito;
                    } else {
                        return 1;
                    }
                    //return 'carrito tiene algo';
                } else {

                    $carrito = session('carrito');
                    $producto['cantidad'] = $cantidad;
                    if ($carrito === NULL)
                        $carrito = [];
                    array_push($carrito, $producto);
                    session(['carrito' => $carrito]);
                    $newProducto = new Carrito;
                    $newProducto->idUsuario = Auth::user()->id;
                    $newProducto->idProducto = $id;
                    $newProducto->idSucursal = session('sucursalEcommerce');
                    $newProducto->cantidad = $cantidad;
                    $newProducto->save();
                    return $carrito;
                    //return 'carrito es nulo';
                }
            }
        }
        $carrito =  session('carrito');

        if (isset($carrito)) {
            $producto = [];
            $producto['id'] = $p->id;
            $producto['imagen'] = $p->imagen;
            $producto['nombre'] = $p->nombre;
            $producto['precio'] = $sp->precio;
            $producto['sucursal'] = session('sucursalEcommerce');
            //$ids = array_column($carrito, 'id');
            //$pos = array_search($producto['id'], $ids);
            $pos = false;
            for ($i = 0; $i < count($carrito); $i++) {
                if ($producto['id'] == $carrito[$i]['id'] && $producto['sucursal'] == $carrito[$i]['sucursal']) {
                    $pos = $i;
                }
            }
            if ($pos === false) {
                $producto['cantidad'] = $cantidad;
                array_push($carrito, $producto);
                session(['carrito' => $carrito]);
                return $carrito;
            } else {

                //$productoSucursal = Sucursal_producto::where('idSucursal', '=',session('sucursalEcommerce'))
                //->where('idProducto','=',$producto['id'])->first();

                $nuevaCantidad = $carrito[$pos]['cantidad'] + $cantidad;
                if ($nuevaCantidad <= $sp->existencia) {
                    $carrito[$pos]['cantidad'] = $nuevaCantidad;
                    session(['carrito' => $carrito]);
                    return $carrito;
                } else {
                    return 1;
                }
            }
            //return $carrito;
        } else {
            $carrito = [];
            $producto = [];


            $producto['cantidad'] = $cantidad;
            $producto['id'] = $p->id;
            $producto['imagen'] = $p->imagen;
            $producto['nombre'] = $p->nombre;
            $producto['precio'] = $sp->precio;
            $producto['sucursal'] = session('sucursalEcommerce');
            array_push($carrito, $producto);
            session(['carrito' => $carrito]);
            return $carrito; //'No existe el carrito';
        }
    }
    public function cambiarSucursal($sucursal)
    {
        session(['sucursalEcommerce' => $sucursal]);
        return json_encode(true); //session('sucursalEcommerces');
    }
    public function carrito()
    {
        $sucursales = Sucursal::all();
        $departamentos = Departamento::where('ecommerce', '=', 1)->get(['id', 'nombre']);
        //$producto = Producto::findOrFail($id);
        //$productoSucursal = Sucursal_producto::where('idSucursal', '=',session('sucursalEcommerce'))
        //->where('idProducto','=',$id)->first();

        return view('Ecommerce.carrito', compact('sucursales', 'departamentos'));
        //session(['sucursalEcommerce'=>$sucursal]);
        //return json_encode(true);//session('sucursalEcommerces');
    }
    public function actualizarCantidadCarrito(Request $request, $id)
    {
        //return 'Todo bien';
        $carrito =  session('carrito');
        //return $carrito;
        //for($i=0 ;$i<count($carrito);$i++)
        $i = 0;
        $pos = true;
        while ($i < count($carrito) && $pos) {

            if ($id == $carrito[$i]['id'] && session('sucursalEcommerce') == $carrito[$i]['sucursal']) {
                $productoSucursal = Sucursal_producto::where('idSucursal', '=', session('sucursalEcommerce'))
                    ->where('idProducto', '=', $id)->first();
                    //return $productoSucursal;
                //$nuevaCantidad = $carrito[$i]['cantidad'] + $request['cantidad'];
                if ($request['cantidad'] <= $productoSucursal->existencia) {
                    $carrito[$i]['cantidad'] = $request['cantidad'];
                    if(Auth::check())
                    {
                        Carrito::where('idUsuario', '=', Auth::user()->id)->where('idProducto', '=', $id)
                        ->where('idSucursal', '=', session('sucursalEcommerce'))
                        ->update(['cantidad' => $request['cantidad']]);
                    }
                } else
                {
                    return $carrito[$i]['cantidad'];
                }

                $pos = false;
            }
            $i++;
        }
        session(['carrito' => $carrito]);
        return $carrito;
    }

    public function quitarProductoDeCarrito(Request $request, $id)
    {
        $i = 0;
        $pos = true;
        $carrito =  session('carrito');
        while ($i < count($carrito) && $pos) {
            if ($id == $carrito[$i]['id'] && session('sucursalEcommerce') == $carrito[$i]['sucursal']) {
                unset($carrito[$i]);
                $carrito = array_values($carrito);
                //$carrito = array_diff($carrito, array($carrito[$i]));
                $pos = true;
            }
            $i++;
        }
        if (Auth::check()) {
            if (Auth::user()->tipo == 2) {
                Carrito::where('idUsuario', '=', Auth::user()->id)->where('idProducto', '=', $id)
                    ->where('idSucursal', '=', session('sucursalEcommerce'))->delete();
            }
        }
        session(['carrito' => $carrito]);
        return $carrito;
    }

    public function pagoPaypal()
    {
        return view('Ecommerce.pruebaPago');
    }

    public function postDireccion(Request $request)
    {

        //return $request->all();
        $datosDomicilio = $request->except('_token');
        $domicilio = new Domicilio;
        $domicilio->idCliente = Cliente::where('idUsuario', '=', session('idCliente'))->first()->id;
        $domicilio->calle = $request['calle'];
        $domicilio->numeroExterior = $request['numeroExterior'];
        $domicilio->numeroInterior = $request['numeroInterior'];
        $domicilio->codigoPostal = $request['codigoPostal'];
        $domicilio->colonia = $request['colonia'];
        //return 'todo bien';
        $domicilio->save();
        //session(['domicilio' => true]);
        if ($request->has('ajax')) {
            return Domicilio::where('idCliente', '=', $domicilio->idCliente)->get();
        }
        return redirect('/direccionEnvio');
    }

    public function actualizarDireccion(Request $request)
    {
        $id =  Auth::user()->id;
        $cliente = Cliente::where('idUsuario', '=', $id)->first();
        $domicilio = request()->except(['_token', 'ajax', 'idDomicilio', 'ciudad', 'estado']);
        //return $domicilio;
        //Domicilio::find($request['idDomicilio']);
        Domicilio::where('id', '=', $request['idDomicilio'])->update($domicilio);
        //return 'Todo bien';
        if ($request->has('ajax')) {
            return Domicilio::where('idCliente', '=', $cliente->id)->get();
        }
        //Domicilio::where('idCliente', '=', $cliente->id)->delete();
        return back();
    }
    public function eliminarDireccion(Request $request)
    {
        $id =  Auth::user()->id;
        $cliente = Cliente::where('idUsuario', '=', $id)->first();
        Domicilio::destroy($request['idDomicilio']);
        if ($request->has('ajax')) {
            return Domicilio::where('idCliente', '=', $cliente->id)->get();
        }
        //Domicilio::where('idCliente', '=', $cliente->id)->delete();
        return back();
    }

    public function direccionEnvio()
    {

        if (session()->has('carrito')) {


            if (!session()->has('idCliente'))
                return redirect('/loginCliente?compra=1');
            $user = User::find(session('idCliente'));
            if (!isset($user)) {
                session()->forget('idCliente');
                return redirect('/loginCliente?compra=1');
            }
            $carrito = session('carrito');
            $ss = array_column($carrito, 'sucursal');
            $pos = array_search(session('sucursalEcommerce'), $ss);
            if ($pos !== false) {
                $id =  Auth::user()->id;
                $cliente = Cliente::where('idUsuario', '=', $id)->first();
                $domicilios = Domicilio::where('idCliente', '=', $cliente->id)->get();
                $nombre = $cliente->nombre;
                $telefono = $cliente->telefono;
                if (count($domicilios) > 0) {
                    /*if (isset($_GET['domicilio']) && $_GET['domicilio'] == 'false') {
                        session(['domicilio' => false]);
                        return view('Ecommerce.domicilio', compact('domicilios'));
                    }*/
                    //if (session()->has('domicilio') && session('domicilio')) {
                    return view('Ecommerce.detalleCompra', compact('carrito', 'nombre', 'domicilios', 'telefono'));
                    //}
                }
                return view('Ecommerce.domicilio');
            }
        }
        return redirect('/carrito');
    }

    public function formaPago()
    {
        if (session()->has('carrito')) {
            if (!Auth::check())
                return redirect('/loginCliente');

            return view('Ecommerce.formaPago');
        }
        return back();
    }

    public function revisionPedido()
    {
        if (!Auth::check())
            return redirect('/loginCliente');
        return view('Ecommerce.revisionPedido');
    }

    public function revisionCompra(Request $request)
    {
        if (!Auth::check())
            return redirect('/loginCliente');
        $pagaCon = $request->input('pago');
        $formaPago = ' Contra Entrega';
        $carrito = session('carrito');
        $id =  Auth::user()->id;
        $cliente = Cliente::where('idUsuario', '=', $id)->first();
        $domicilio = Domicilio::where('idCliente', '=', $cliente->id)->first();

        $telefono = $cliente->telefono;
        return view('Ecommerce.revisionCompra', compact('cliente', 'domicilio', 'telefono', 'carrito', 'pagaCon', 'formaPago'));
    }

    public function resumen($datos, $folio)
    {
        if (!Auth::check())
            return redirect('/loginCliente');
        $pagarCon = $datos;
        $folio = $folio;
        $formaPago = 'Contra Entrega';
        $carrito = session('carrito');
        $id =  Auth::user()->id;
        $cliente = Cliente::where('idUsuario', '=', $id)->first();
        $domicilio = Domicilio::where('idCliente', '=', $cliente->id)->first();
        $nombre = $cliente->nombre;
        $telefono = $cliente->telefono;
        Carrito::where('idUsuario', '=', Auth::user()->id)->delete();
        $carrito = session('carrito');
        $carritoReset = [];
        session(['carrito' => $carritoReset]);
        return view('Ecommerce.compraGenerada', compact('nombre', 'domicilio', 'telefono', 'carrito', 'formaPago', 'pagarCon', 'folio', 'carrito'));
    }
    public function insertarSolicitud(Request $request)
    {
        $id =  Auth::user()->id;
        $idCliente = Cliente::where('idUsuario', '=', $id)->first()->id;
        $datosDomicilio = $request->except('_token');
        $formaPago = $request->input('formaPago');
        $pagaCon = $request->input('pagaCon');
        $cambio = $request->input('cambio');
        $direccion = $request->input('direccion');
        //$idCliente = $request->input('idCliente');
        $subtotal = $request->input('subtotal');
        $costoEnvio = $request->input('costoEnvio');
        $total = $request->input('total');

        $pedidoCompra = new Pedido_contra_entrega; //credito
        $pedidoCompra->idCliente = $idCliente;
        $pedidoCompra->idSucursal = session('sucursalEcommerce');
        $pedidoCompra->direccion = $direccion;
        $pedidoCompra->subtotal = $subtotal;
        $pedidoCompra->costoEnvio = $costoEnvio;
        $pedidoCompra->total = $total;
        $pedidoCompra->pagarCon = $pagaCon;
        $pedidoCompra->cambio = $cambio;
        //return $pedidoCompra;
        $pedidoCompra->save();

        $folioPedido = $pedidoCompra->id;

        $datos = $request->input('datos');
        $datosCodificados = json_decode($datos, true);
        foreach ($datosCodificados as $datosProducto) {
            $idSucursal = $datosProducto['idSucursal'];
            $sucursal_producto = Sucursal_producto::where('idProducto', '=', $datosProducto['idProducto'])
                ->where('idSucursal', '=', $idSucursal); //->update(['existencia'=>'11']);
            $idSucProd =  $sucursal_producto->first()->id;
            $detalle = new detallePedido_CE();
            $detalle->idPedido = $pedidoCompra->id;
            //$detalle->idSucProd = $idSucProd ;
            $detalle->idProducto = $datosProducto['idProducto'];
            $detalle->precio =  $datosProducto['precio'];
            $detalle->cantidad = $datosProducto['cantidad'];
            $detalle->subtotal = $datosProducto['subtotal'];
            $detalle->save();
            //Actualizar existencia
            /*
            $productosSucursal = Sucursal_producto::where('idProducto', '=', $datosProducto['idProducto'])
            ->where('idSucursal', '=', session('sucursal')); //->update(['existencia'=>'11']);
            */
            // $existencia = $sucursal_producto->first()->existencia - $datosProducto['cantidad'];
            // $sucursal_producto->update(['existencia' => $existencia]);
        }
        //Datos a enviar para siguiente vista
        //return view('Ecommerce.compraGenerada');
        // return $pagaCon;

        return compact('pagaCon', 'folioPedido');
        // return compact('nombre', 'domicilio', 'telefono', 'carrito','formaPago');
    }

    public function menu()
    {
        //return url()->current();
        if (!Auth::check())
            return redirect('/loginCliente');
        //$this->middleware('verified');
        $sucursales = Sucursal::all();
        $departamentos = Departamento::where('ecommerce', '=', 1)->get(['id', 'nombre']);
        $cliente = Cliente::where('idUsuario', '=', session('idCliente'))->first();
        $domicilios = Domicilio::where('idCliente', '=', $cliente->id)->get();
        $pedidosContraEntrega = Pedido_contra_entrega::where('idCliente', '=', $cliente->id)->get();
        $detallePedidos = detallePedido_CE::get();
        $ventasContraEntrega = Venta::where('tipo', '=', 'ecommerce')->get();
        $ventasClientes = Venta_cliente::get();
        $detalleVentaPedidos = Detalle_venta::get();
        $productos = Producto::get();
        return view('Ecommerce.vistaCliente', compact(
            'sucursales',
            'departamentos',
            'domicilios',
            'cliente',
            'pedidosContraEntrega',
            'ventasContraEntrega',
            'ventasClientes',
            'detallePedidos',
            'detalleVentaPedidos',
            'productos'
        ));
    }

    public function actualizarDatosCliente(Request $request)
    {
        $datos = [];
        $cliente = Cliente::where('idUsuario', '=', session('idCliente'))->first();
        $user = Auth::user();

        if ($request->input('nombre') != $cliente->nombre)
            $datos = Arr::add($datos, 'nombre', $request->input('nombre'));
        if ($request->input('apellidoPaterno') != $cliente->apellidoPaterno)
            $datos = Arr::add($datos, 'apellidoPaterno', $request->input('apellidoPaterno'));
        if ($request->input('apellidoMaterno') != $cliente->apellidoMaterno)
            $datos = Arr::add($datos, 'apellidoMaterno', $request->input('apellidoMaterno'));
        if ($request->input('telefono') != $cliente->telefono)
            $datos = Arr::add($datos, 'telefono', $request->input('telefono'));
        if ($request->input('username') != $user->username)
            $datos = Arr::add($datos, 'username', $request->input('username'));
        if ($request->input('email') != $user->email)
            $datos = Arr::add($datos, 'email', $request->input('email'));
        $validacion =  Validator::make($datos, [
            'nombre' => ['string', 'max:30', 'min:3'],
            'apellidoPaterno' => ['string', 'max:30', 'min:3'],
            'apellidoMaterno' => ['string', 'max:30', 'min:3'],
            //'domicilio' => ['string', 'max:191','min:3'],
            'telefono' => ['string', 'max:10', 'min:7'],
            'username' => ['string', 'max:255', 'unique:users', 'min:3'],
            'email' => ['string', 'email', 'max:255', 'unique:users', 'min:5'],
        ]);
        if ($validacion->fails()) :
            return back()->withErrors($validacion)->with(['cambios' => true])->withInput($request->all());
        endif;
        $datosCliente = request()->except(['_token', 'email', 'username']);
        $datosUser = request()->only(['email', 'username']);
        Cliente::where('idUsuario', '=', session('idCliente'))->update($datosCliente);
        User::where('id', '=', session('idCliente'))->update($datosUser);
        return back(); //redirect('/')
    }

    public function verSeguimientoPedido($id)
    {
        $venta = Venta::findOrFail($id);
        $idVenta = $venta->id;
        $ventaCliente = Venta_cliente::where('idVenta', '=', $id)->first();
        return view('Ecommerce.seguimiento_pedido', compact('venta', 'ventaCliente', 'idVenta'));
    }

    public function generarComprobante($id)
    {
        //$pedidosContraEntrega = Pedido_contra_entrega::where('idCliente', '=', $cliente->id)->get();
        $detallePedidos = detallePedido_CE::get();

        $venta = Venta::findOrFail($id);
        $ventaCliente = Venta_cliente::where('idVenta', '=', $id)->first();
       // $idCliente = $ventaCliente->idCliente;
      //  $idSucEmp = $venta->idSucursalEmpleado;
        $idSuc = Sucursal_empleado::findOrFail($venta->idSucursalEmpleado);
        $sucursal = Sucursal::findOrFail($idSuc->idSucursal);
        $cliente = Cliente::findOrFail( $ventaCliente->idCliente);
        
        $productos  = Detalle_venta::where('idVenta','=', $id)->get();
        $productosPedido = [];
        
        foreach($productos as $productos2){
            $idProducto = $productos2->idProducto;
            $prod = Producto::findOrFail($idProducto);

            $objProducto = [
                // 'estado' => $estado,
                'codigoBarras' => $prod->codigoBarras,
                'nombre' => $prod->nombre, //session('idSucursalEmpleado'),
                'receta' => $prod->receta,
                'cantidad' => $productos2->cantidad,
            ];
            
            array_push($productosPedido, $objProducto);
        }
      //  $productos = $productosPedido;
       // return $productos;
        //return $productosPedido;
        return view('Ecommerce.comprobante', compact('venta', 'ventaCliente', 'cliente','sucursal', 'productosPedido'));
    }

    public function verificacionEmail()
    {
        /*Fortify::verifyEmailView(function () {
            return view('auth.verify-email');
        });*/

        Fortify::loginView(function () {
            return view('auth.login');
        });
    }

    public function busquedaTiempoReal()
    {
        
        $array = [];
        if (isset($_GET['buscar']))
            $producto = $_GET['buscar'];
        else {
            return view('Ecommerce.busqueda', compact('array'));
        }
        $datos = DB::table('productos')
            ->join('sucursal_productos', 'productos.id', '=', 'sucursal_productos.idProducto')
            ->where([
                ['productos.nombre', 'like', '%' . $producto . '%'],
                ['sucursal_productos.idSucursal', '=', session('sucursalEcommerce')]
            ])
            ->orWhere([
                ['sucursal_productos.idSucursal', '=', session('sucursalEcommerce')],
                ['productos.descripcion', 'like', '%' . $producto . '%']
            ])
            ->select('*')->limit(5)->get();
        //->groupBy('sucursal_empleados.idSucursal')

        $array = json_decode(json_encode($datos), true);
        return $array;
    }
}
