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

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = ['verProducto','crearProducto','eliminarProducto','modificarProducto','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        
        $depas['d']= Departamento::paginate();
        $datosP= Producto::all();
        $depa= Departamento::all();
        $idSucursal = session('sucursal');
        $producto = Producto::all();
        $productosSucursal = Sucursal_producto::where('idSucursal', '=', $idSucursal)->where('status', '=', 1)->get();
        $subproducto = Subproducto::all();
        $ofertas = Oferta::all();
     //   return $idSucursal;
         return view('Producto.index',$depas, compact('depa', 'datosP','productosSucursal', 'producto','subproducto', 'ofertas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuarios = ['crearProducto','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        
        $producto['producto']= Producto::paginate();
        $departamento= Departamento::all();
        return view('Producto.create', compact('departamento'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuarios = ['crearProducto','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        
        try{

        $datosProducto = request()->except('_token', 'minimoStock');
      //  $datosProducto['existencia']=0;
     //   $datosProducto['costo']=0;
     //   $datosProducto['precio']=0;
     $idSucursal = session('sucursal');
        if($request->hasFile('imagen')){
            $datosProducto['imagen']=$request->file('imagen')->store('uploads','public');
        }
        $producto = Producto::create($datosProducto);
        $datosSP['costo']= 0;
       $datosSP['precio']= 0;
       $datosSP['existencia']= 0;
       $datosSP['minimoStock']= $request->input('minimoStock');//$datosProducto['minimoStock'];
       $datosSP['status']= 1;
       $datosSP['idSucursal'] = $idSucursal;
       $datosSP['idProducto'] = $producto->id;
       Sucursal_producto::create($datosSP);

       // return response()->json($datosProducto);
      // TempData["success"] = "registro grabado";
     //::success('this is a test message');
    
        return redirect('/puntoVenta/producto');
    }catch (\Illuminate\Database\QueryException $e){
        return redirect()->back()->withInput()->withErrors(['mensajeError' => 'El CODIGO DE BARRAS Y/O NOMBRE YA EXISTE, AGREGUE UNO DIFERENTE']);
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show($producto)//Producto $producto)
    {
        
        if($producto=="productos")
        {
            //$usuarios = ['crearVenta','admin'];
        //Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        
            $productos = Producto::all();
            $productosCodificados = json_encode($productos);
            return $productos;//compact('productos');
        }
        else{
            $usuarios = ['verProducto','crearProducto','eliminarProducto','modificarProducto','admin'];
            Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
            return Producto::where("nombre",'like',$producto."%")->paginate(30,
            ['id', 'codigoBarras', 'nombre', 'idDepartamento'])->all();
            //$existencia = Producto::where("")
            //$id = Producto::whereColumn('minimo_stock','>=','existencia')->get();
            //return $id;
        }
    }
    public function show2($id)
    {
        $usuarios = ['verProducto','crearProducto','eliminarProducto','modificarProducto','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        
        $producto= Producto::findOrFail($id);
        return view('Producto.edit', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuarios = ['eliminarProducto','modificarProducto','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        
        $departamento= Departamento::all();
        $producto= Producto::findOrFail($id);
       // $sucursalProd = Sucursal_producto::where('idProducto', '=', $id)->get();
        $idSucursal = session('sucursal');
        $sucursalProd = Sucursal_producto::where('idSucursal', '=', $idSucursal)->get();
     return view('Producto.edit', compact('producto', 'departamento', 'sucursalProd'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function stock(){
        
        $productos= Producto::all();
        $idSucursal = session('sucursal');
        $productosSucursal= Sucursal_producto::where('idSucursal', '=', $idSucursal)->get();
        $depa= Departamento::all();
        return view('Producto.stockV', compact('productos', 'depa', 'productosSucursal'));
        
    }
    public function update(Request $request, $id)
    {
        $usuarios = ['modificarProducto','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        
        $datosProducto = request()->except('_token', 'minimoStock');
       if($request->hasFile('imagen')){
        $producto=Producto::findOrFail($id);
        Storage::delete('public/'.$producto->imagen);
        $datosProducto['imagen']=$request->file('imagen')->store('uploads','public');
    }
        $producto = Producto::findOrFail($id);
        $producto->update($datosProducto);


       // $producto = Producto::where('id', '=', $id)->update($datosProducto);

        //  $datosSP['costo']= 0;
        // $datosSP['precio']= 0;
        // $datosSP['existencia']= 0;
         $datosSP['minimoStock']= $request->input('minimoStock');
         $sp = Sucursal_producto::where('idProducto', '=', $id);
         $sp->update($datosSP);
       //   Sucursal_producto::create($datosSP);
        ///
        return redirect('puntoVenta/producto');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    //public function destroy(Producto $producto)
    public function eliminar($id){
        $usuarios = ['eliminarProducto','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        
        $producto= Producto::findOrFail($id);
        return view('Producto/delete', compact('producto'));
    }

    public function destroy($id)
    {
       // return "HOLA";
        //buscaar todos los datos que corresponden a este id
        $producto= Producto::findOrFail($id);
      //  $producto= Producto::where('idProducto', '=', $id);

       // if( Storage::delete('public/'.$producto->imagen)){
            //Producto::destroy($producto->id);
            Producto::destroy($producto->$id);
       // } 
       // return redirect('puntoVenta/producto');
       return "HOLA";
    }

    public function buscarProducto(Request $request)
    {
        $productosB['productos'] = Producto::where("id",'=',$request->texto)->get();
        return view('Producto.producto',$productosB);//compact('productoB'));
        //return compact('productoB');
    }
    public function buscador(Request $request)
    {
        $datosConsulta['departamentosB'] = Producto::where("nombre",'like',$request->texto."%")->get();
        return view('Departamento.form',$datosConsulta);
        //return $datosConsulta;
    }
    public function eliminar3($id){
        $idSucursal = session('sucursal');
      //  $productosSucursal= Sucursal_producto::where('idSucursal', '=', $idSucursal)->get();
            $producto = Sucursal_producto::where('idSucursal', '=', $idSucursal)->where('idProducto','=',$id);
            $dato['status']= 0;
            $dato['existencia'] = 0;
           $producto->update($dato);
           // Sucursal_producto::where('idProducto',$id)->first()->update($dato);
            return redirect()->back();
        
    }

    //PRODUCTOS ADMINISTRADOR
    public function productosAll(){
        $producto = Producto::all();
        return $producto;
        //return compact('sucursalesInac');
    }
    //ELIMINAR PRODUCTO POR EL ADMINISTRADOR
    
    public function eliProd($id)//Sucursal $sucursal)
    {
       // $producto = Producto::all();
       $usuarios = ['eliminarProducto','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        
            try{
                Producto::destroy($id);
                return redirect('puntoVenta/administracion');
            } catch (\Illuminate\Database\QueryException $e) { 
               
            return redirect()->back()->withErrors(['noEliminado' => 'EL PRODUCTO NO SE PUDO ELIMINAR PORQUE ESTA EN USO']);
        } 
        
    }
}
