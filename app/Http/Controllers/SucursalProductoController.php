<?php

namespace App\Http\Controllers;
use App\Models\Oferta;
use App\Models\Sucursal;
use App\Models\Sucursal_producto;
use App\Models\Sucursal_empleado;
use App\Models\Producto;
use App\Models\Subproducto;
use App\Models\Productos_caducidad;
use Illuminate\Http\Request;

class SucursalProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        
        $usuarios = ['crearProducto','crearCompra','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        //return 'Todo bien';
        $datos = $request->input('datos');
        $datosCodificados = json_decode($datos,true);
        foreach($datosCodificados as $datosProducto)
        {
            //return $datosProducto['fechaCaducidad'];
            //$actualizarProductoInd = Sucursal_producto::find($datosProducto['id']);//->update(['existencia'=>]);
            $sucursalProducto = new Sucursal_producto;//::where('idSucursal','=',session('sucursal'))
            //->where('idProducto', '=',$datosProducto['id'])->get()->first();
            $sucursalProducto->idSucursal = session('sucursal');
            $sucursalProducto->idProducto = $datosProducto['id'];
            $sucursalProducto->existencia = $datosProducto['cantidad'];
            $sucursalProducto->costo = $datosProducto['costo'];
            $sucursalProducto->precio = $datosProducto['precio'];
            $sucursalProducto->minimoStock = 10;
            $sucursalProducto->status = 1;
            $sucursalProducto->save();
            //$actualizarProductoInd->save();
            if($datosProducto['fechaCaducidad'] == 1)
            {
                $productoCaducidad = new Productos_caducidad;
                $productoCaducidad->idSucursalProducto = $sucursalProducto->id;
                $productoCaducidad->fecha_caducidad = $datosProducto['caducidad'];
                $productoCaducidad->cantidad = $datosProducto['cantidad'];
                $productoCaducidad->oferta = false;
                $productoCaducidad->save();
            }
        }

        
    }
    public function crear($id){
        return "creado";
    }
    public function act_inventario(){
        $idSucursal = session('sucursal');
        $subproducto = Subproducto::all();
        $productosSucursal = Sucursal_producto::where('idSucursal', '=', $idSucursal)->where('status', '=', 1)->get();
        return compact('productosSucursal', 'subproducto');
    }

    public function actPrecio(Request $request,$id){
        $suc_prod = Sucursal_producto::findOrFail($id);
        //return $suc_prod;
        $precio['precio'] =  $request->input('precio');
        $suc_prod->update($precio);
        return true;
        //return  redirect('/puntoVenta/producto');

    }
    public function actCosto(Request $request,$id){
        $suc_prod = Sucursal_producto::findOrFail($id);
        $costo['costo'] =  $request->input('costo');
        $suc_prod->update($costo);
        return  true;
    }
    public function actExistencia(Request $request,$id){
        $suc_prod = Sucursal_producto::findOrFail($id);
       // $existencia['existencia'] = $suc_prod->existencia + $request->input('cantidad');
        $existencia['existencia'] = $request->input('cantidad');
        $suc_prod->update($existencia);
        return  true;
    }

    
    


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sucursal_producto  $sucursal_producto
     * @return \Illuminate\Http\Response
     */
    public function show($id)//Sucursal_producto $sucursal_producto)
    {
        //if($id=='todos')
        
        return Sucursal_producto::where('idSucursal', '=',$id)->get();//->where('status','=',1)->get();
    }

    public function agregarProdStock_Suc($id){
        $producto= Producto::findOrFail($id);
        $datosSP['costo']= 0;
        $datosSP['precio']= 0;
        $datosSP['existencia']= 0;
        $datosSP['minimoStock']= 0 ;//$datosProducto['minimoStock'];
        $datosSP['status']= 1;
        $idSucursal = session('sucursal');
        $datosSP['idSucursal'] = $idSucursal;
        $datosSP['idProducto'] = $producto->id;
        Sucursal_producto::create($datosSP);

         return redirect('/puntoVenta/producto');
    }

    //ENVIAR DATOS: PRODUCTOS DADOS DE BAJA ESTA SUCURSAL
    public function productos_baja(){
        $idSucursal = session('sucursal');
        $productosBaja = Sucursal_producto::where('idSucursal', '=', $idSucursal)->where('status', '=', 0)->get();
       // $producto= Producto::findOrFail($productosBaja->idProducto)->get();
     //  $id= $productosBaja->idProducto->get();
      //  $producto = Producto::all();
        return  $productosBaja;
    }
    //ALTA PRODUCTO A SUCURSALES
    public function altaProductoS($id){
        $idSucursal = session('sucursal');
        $producto = Sucursal_producto::where('idSucursal', '=', $idSucursal)->where('idProducto', '=', $id);
        $dato['status']= 1;
        $producto->update($dato);
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sucursal_producto  $sucursal_producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Sucursal_producto $sucursal_producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sucursal_producto  $sucursal_producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)//, Sucursal_producto $sucursal_producto)
    {
        $usuarios = ['modificarEmpleado','crearCompra','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        
        if($id == 'productos')
        {
            $datos = $request->input('datos');
            $datosCodificados = json_decode($datos,true);
            
            foreach($datosCodificados as $datosProducto)
            {
                
                //$actualizarProductoInd = Producto::find($datosProducto['id']);//->update(['existencia'=>]);
                $actualizarProducto = Sucursal_producto::where('idSucursal','=',session('sucursal'))
                ->where('idProducto', '=',$datosProducto['id'])->get()->first();
                $actualizarProducto->existencia = $actualizarProducto['existencia'] + $datosProducto['cantidad'];
                $actualizarProducto->status = 1;
                $actualizarProducto->costo = $datosProducto['costo'];
                $actualizarProducto->precio = $datosProducto['precio'];
                $actualizarProducto->save();
                
                if($datosProducto['fechaCaducidad'] == 1)
                {
                    $productoCaducidad = new Productos_caducidad;
            
                    $productoCaducidad->idSucursalProducto = $actualizarProducto->id;//$datosProducto['id'];
                    $productoCaducidad->fecha_caducidad = $datosProducto['caducidad'];
                    $productoCaducidad->cantidad = $datosProducto['cantidad'];
                    $productoCaducidad->oferta = false;
                    $productoCaducidad->save();
                }
                
            }
            return 'Proceso terminado';
        }
        if(isset($request['restar']))
        {
            $producto = Sucursal_producto::findOrFail($id);//->update(['existencia' =>])
            $resta = $producto->existencia - $request['restar'];
            $producto->update(['existencia' => $resta]);
            return $resta;
        }
        return 'No hizo nada';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sucursal_producto  $sucursal_producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sucursal_producto $sucursal_producto)
    {
        //
    }

    public function inventarioRapido($total)
    {
        //return session()->all();
        $productosRapidos = [];
        $productosSucursal = Sucursal_producto::where('idSucursal', '=',session('sucursal'))->get(['id','idProducto','existencia']);
        $subproductosSucursal = [];
        foreach($productosSucursal as $pS)
        {
            $subproducto = Subproducto::where('idSucursalProducto', '=',$pS->id)->first(['existencia']);
            if(isset($subproducto))
            {
                $subproducto->idProducto = $pS->idProducto;
                $subproducto->id = $pS->id;
                array_push($subproductosSucursal,$subproducto);
            }
                
        }
        $totalProductos = count($productosSucursal) + count($subproductosSucursal);
        if($total>$totalProductos)
            $total = $totalProductos;
        $valores = [];
        for($i=0;$i<$total;$i++)
        {
            do {
                $valor = mt_rand(1, $totalProductos);
            } while (in_array($valor, $valores)); 
            array_push($valores,$valor);
            //if(in_array($valor, $valores))
            if($valor>count($productosSucursal))
            {
                $valorAux = $valor - count($productosSucursal);
                $producto = Producto::findOrFail($subproductosSucursal[$valorAux-1]->idProducto);
                $subproductosSucursal[$valorAux-1]->nombre = $producto->nombre." (SUBPRODUCTO)";
                $subproductosSucursal[$valorAux-1]->producto = false;
                array_push($productosRapidos,$subproductosSucursal[$valorAux-1]);
            }
            else{
                $producto = Producto::findOrFail($productosSucursal[$valor-1]->idProducto);
                $productosSucursal[$valor-1]->nombre = $producto->nombre;
                //$productosSucursal[$valor-1]->nombre = $producto->nombre;
                $productosSucursal[$valor-1]->producto = true;
                array_push($productosRapidos,$productosSucursal[$valor-1]);
            }
        }
        return $productosRapidos;// view('Producto.inventarioRapido');
    }
    
}
