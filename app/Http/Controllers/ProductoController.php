<?php

namespace App\Http\Controllers;
use App\Models\Producto;
use App\Models\Departamento;
use App\Models\Subproducto;
use App\Models\Sucursal_producto;
use App\Models\Sucursal_empleado;
use App\Models\Oferta;

use Illuminate\Http\Request;
//para poder borrar informacion de los registros de la carpeta uploads de storage
use Illuminate\Support\Facades\Storage;

//para poder importar archivos excel
use App\Imports\InventarioImport;
use Maatwebsite\Excel\Facades\Excel;

class ProductoController extends Controller
{
    public function index()
    {
        $usuarios = ['verProducto','crearProducto','eliminarProducto','modificarProducto','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);
        $idSucursal = session('sucursal');
        $productosSucursal = Sucursal_producto::where('idSucursal', '=', $idSucursal)//->where('status', '=', 1)
        ->get(['id','costo','precio','existencia','minimoStock','idProducto','status']);
        $depas['d']= Departamento::paginate();
        $datosP= Producto::all(['id','codigoBarras', 'nombre','descripcion','receta' ,'idDepartamento','imagen']);
        $depa= Departamento::all(['id','nombre']);
        $producto = Producto::all(['id','codigoBarras', 'nombre','descripcion','receta' ,'idDepartamento','imagen']);
        $subproducto = Subproducto::all();
        $ofertas = Oferta::all();
         return view('Producto.index',$depas, compact('depa', 'datosP','productosSucursal', 'producto','subproducto', 'ofertas'));
    }

    public function create()
    {
        $usuarios = ['crearProducto','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);
        $producto['producto']= Producto::paginate();
        $departamento= Departamento::all();
        return view('Producto.create', compact('departamento'));
    }

    public function store(Request $request)
    {
        $usuarios = ['crearProducto','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);
        try{
        $datosProducto = request()->except('_token', 'minimoStock','existencia','costo','precio','ajax');
        $idSucursal = session('sucursal');
        if($request->hasFile('imagen')){
            $datosProducto['imagen']=$request->file('imagen')->store('uploads','public');
        }
        else{
            $datosProducto['imagen'] = null;
        }
        $producto = Producto::create($datosProducto);
        if($request->has('ajax'))
        {
            $datosSP['costo']= 0;
            $datosSP['precio']= 0;
            $datosSP['existencia']= 0;
            $datosSP['minimoStock']= $request->input('minimoStock');
            $datosSP['status']= 1;
            $datosSP['idSucursal'] = $idSucursal;
            $datosSP['idProducto'] = $producto->id;
            Sucursal_producto::create($datosSP);
            return $producto;
        }

       $datosSP['costo']= $request->input('costo');
       $datosSP['precio']= $request->input('precio');
       $datosSP['existencia']= $request->input('existencia');
       $datosSP['minimoStock']= $request->input('minimoStock');
       $datosSP['status']= 1;
       $datosSP['idSucursal'] = $idSucursal;
       $datosSP['idProducto'] = $producto->id;
       Sucursal_producto::create($datosSP);
        return redirect()->back()->withErrors(['mensajeConf' => 'PRODUCTO CREADO CORRECTAMENTE']);
    }catch (\Illuminate\Database\QueryException $e){
        if($request->has('ajax'))
           { return false;}
        return redirect()->back()->withInput()->withErrors(['mensajeError' => 'El CODIGO DE BARRAS Y/O NOMBRE YA EXISTE, AGREGUE UNO DIFERENTE']);
    }
    }

    public function show($producto)//Producto $producto)
    {
        if($producto=="productos")
        {
            $productos = Producto::all();
            $productosCodificados = json_encode($productos);
            return $productos;
        }
        else{
            $usuarios = ['verProducto','crearProducto','eliminarProducto','modificarProducto','admin'];
            Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);
            $productos = Producto::where("nombre",'like',$producto."%")->paginate(30,
            ['id', 'codigoBarras', 'nombre', 'idDepartamento'])->all();
            for($i=0;$i< count($productos);$i++)
            {
                $sP = Sucursal_producto::where('idProducto', '=', $productos[$i]->id)->where('idSucursal','=',session('sucursal'))
                ->first(['existencia','costo','precio']);
                if(isset($sP))
                {
                    $productos[$i]->existencia = $sP->existencia;
                    $productos[$i]->costo = $sP->costo;
                    $productos[$i]->precio = $sP->precio;
                    $productos[$i]->idSucursal = true;
                }else{
                    $productos[$i]->existencia = 0;
                    $productos[$i]->costo = 0;
                    $productos[$i]->precio = 0;
                    $productos[$i]->idSucursal = false;
                }
            }
            return $productos;
        }
    }
    public function show2($id)
    {
        $usuarios = ['verProducto','crearProducto','eliminarProducto','modificarProducto','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);
        $producto= Producto::findOrFail($id);
        return view('Producto.edit', compact('producto'));
    }

    public function edit($id)
    {
        $usuarios = ['eliminarProducto','modificarProducto','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);
        $departamento= Departamento::all();
        $producto= Producto::findOrFail($id);
        $idSucursal = session('sucursal');
        $sucursalProd = Sucursal_producto::where('idSucursal', '=', $idSucursal)->get();
     return view('Producto.edit', compact('producto', 'departamento', 'sucursalProd'));
    }

    public function stock(){
        //$productos= Producto::all(['id','codigoBarras', 'nombre','descripcion','receta' ,'idDepartamento']);
        //$idSucursal = session('sucursal');
        //$productosSucursal= Sucursal_producto::where('idSucursal', '=', $idSucursal)->get(['id','costo','precio','existencia','minimoStock','idProducto','status']);
        //$noAgregado = $productos::where('id','!=' )
        $depa= Departamento::all();
        //$noAgregado = [];
        /*
        foreach($productos as $p)
        {
            $bandera = true;
            foreach($productosSucursal as $ps)
            {
                if($bandera){
                if($p->id == $ps->idProducto){
                    $bandera = false;
                }else{
                    array_push($noAgregado,$p);

                }
                }
            }


        }
        */
        return view('Producto.stockV',compact('depa'));//, compact('productos', 'depa', 'productosSucursal'));
       // return view('Producto.stockV', compact('depa', 'noAgregado'));
    }

    public function buscarStock($producto)
    {
        $producto = json_decode($producto);
        $productosStock = [];
        $productos = Producto::where("nombre",'like',"%".$producto."%")
        ->orWhere("codigoBarras",'like',"%".$producto."%")->get();
        foreach($productos as $p)
        {
            if(count($productosStock)>=30)
                {return json_encode($productosStock);}
            $sP = Sucursal_producto::where('idProducto', '=', $p->id)->where('idSucursal','=',session('sucursal'))->first();
            if(!isset($sP))
            {
                array_push($productosStock,$p);
            }
        }
        return json_encode($productosStock);
    }

    public function update(Request $request, $id)
    {
        $usuarios = ['modificarProducto','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);
        $datosProducto = request()->except('_token', 'minimoStock','ajax');
        if($request->hasFile('imagen')){
            $producto=Producto::findOrFail($id);
            Storage::delete('public/'.$producto->imagen);
            $datosProducto['imagen']=$request->file('imagen')->store('uploads','public');
        }
        $producto = Producto::findOrFail($id);
        $producto->update($datosProducto);
         $datosSP['minimoStock']= $request->input('minimoStock');
         $sp = Sucursal_producto::where('idProducto', '=', $id);
         $sp->update($datosSP);
        if($request['ajax'])
        {
            if(isset($datosProducto['imagen']))
                {return $datosProducto['imagen'];}
            else
                {return 1;}
        }
        return redirect('puntoVenta/producto');
    }
    public function eliminar($id){
        $usuarios = ['eliminarProducto','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);
        $producto= Producto::findOrFail($id);
        return view('Producto/delete', compact('producto'));
    }

    public function destroy($id)
    {
        $producto= Producto::findOrFail($id);
      //  $producto= Producto::where('idProducto', '=', $id);
       // if( Storage::delete('public/'.$producto->imagen)){
            //Producto::destroy($producto->id);
            Producto::destroy($producto->$id);
       return "HOLA";
    }
    public function buscarProducto(Request $request)
    {
        $productosB['productos'] = Producto::where("id",'=',$request->texto)->get();
        return view('Producto.producto',$productosB);
    }
    public function buscador(Request $request)
    {
        $datosConsulta['departamentosB'] = Producto::where("nombre",'like',$request->texto."%")->get();
        return view('Departamento.form',$datosConsulta);
    }
    public function eliminar3($id){
        $idSucursal = session('sucursal');
            $producto = Sucursal_producto::where('idSucursal', '=', $idSucursal)->where('idProducto','=',$id);
            $dato['status']= 0;
            $dato['existencia'] = 0;
           $producto->update($dato);
            return redirect()->back();
    }

    //PRODUCTOS ADMINISTRADOR
    public function productosAll(){
        return Producto::all();
    }
    //ELIMINAR PRODUCTO POR EL ADMINISTRADOR
    public function eliProd($id)//Sucursal $sucursal)
    {
       $usuarios = ['eliminarProducto','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);
            try{
                Producto::destroy($id);
                return redirect('puntoVenta/administracion');
            } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['noEliminado' => 'EL PRODUCTO NO SE PUDO ELIMINAR PORQUE ESTA EN USO']);
        }
    }
    public function import($nombreArchivo)
    {
        //(new VehiclesImport)->import('vehicles.xlsx');
        //Excel::import(new InventarioImport, 'inventarioFarmaciasGi.xlsx');
        Excel::import(new InventarioImport,'inventario2022v3.xlsx');
        /*$productos = Producto::all();
        foreach($productos as $producto)
        {
            Sucursal_producto::create([
                $sp['costo'] = $producto->
            ]);
        }*/
        return redirect('/')->with('success', 'File imported successfully!');
        //return Excel::import(new InventarioImport, 'inventarioFarmaciasGi.xlsx');
    }
}
