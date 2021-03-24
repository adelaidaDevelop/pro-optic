<?php

namespace App\Http\Controllers;

use App\Models\Subproducto;
use App\Models\Producto;
use App\Models\Sucursal_empleado;
use App\Models\Departamento;
use Illuminate\Http\Request;
use App\Models\Sucursal_producto;

class SubproductoController extends Controller
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
        
        $subproductos = Subproducto::all();
        $idSucursal = session('sucursal');
        $sucursalProd = Sucursal_producto::where('idSucursal', $idSucursal)->get();
        $productos = Producto::all();
          return view('Subproducto.index',compact('subproductos', 'productos','sucursalProd'));

/*
          $datosProd['producto'] = Producto::paginate();
          $departamentos['d']= Departamento::paginate();
          $departamento= Departamento::all();
              return view('Producto.index',$datosProd,$departamentos, compact('departamento'));
   */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $usuarios = ['crearProducto','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        
        //$idSucProd = 1;
       // $datosProd['producto'] = Producto::paginate(); necesito este: producto
       $idProd = $request->input('id');

       $datosP= Producto::all();
        $subproducto2['subproducto']= SubProducto::paginate();
         $producto=Producto::all();
         $depas = Departamento::all();
        $idSucursal = session('sucursal');
        $productosSucursal = Sucursal_producto::where('idSucursal', '=',$idSucursal)->get();
         return view('Subproducto.agregar', compact('producto', 'datosP', 'productosSucursal','depas','idProd'));
    }

    public function existeEnSubproducto(Request $request){
        $idProd = $request->input('id'); 
        $producto=Producto::all();
        $subproducto= Subproducto::all();
        $idSucursal = session('sucursal');
        $productosSucursal = Sucursal_producto::where('idSucursal', '=',$idSucursal)->where('idProducto', $idProd)->get();
       // $productosSucursal = Sucursal_producto::where('idSucursal', '=',$idSucursal)->get();
        return compact('producto',  'productosSucursal','idProd','subproducto');
    }
    public function actExistencia(Request $request){
        $id = $request->input('idSucProd');
        $subproducto = Subproducto::where('idSucursal', '=', $id);
        $suc_prod = Sucursal_producto::findOrFail($id);
        $existencia1['existencia'] = $suc_prod->existencia - 1;
        $suc_prod->update($existencia1);
        $existencia['existencia'] =$subproducto['piezas'] + $subproducto['existencia'];
        $subproducto->update($existencia);
        return redirect('puntoVenta/producto');
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
        
       // $datosSubproducto = request()->except('_token');
        $datosSubproducto = $request->except('_token');
        $idSP = $datosSubproducto['idSucursalProducto'];
        $sucProd = Sucursal_producto::findOrFail($idSP);
        $idProducto = $sucProd['idProducto'];
       // $existenciaNue['existencia'] = 
       // return $idProducto;
       Subproducto::create($datosSubproducto);
       $actualizarProducto = Sucursal_producto::where('idSucursal','=',session('sucursal'))
        ->where('idProducto', '=', $idProducto)->get()->first();
        $existenciaNuevo['existencia'] = $actualizarProducto->existencia - 1;
        //return $existenciaNuevo;
       $actualizarProducto->update($existenciaNuevo);
       return redirect('puntoVenta/producto');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subproducto  $subproducto
     * @return \Illuminate\Http\Response
     */
    public function show($idS)//Subproducto $subproducto)
    {
        $subproductos = Subproducto::all();
        $productosS = [];
        
        foreach($subproductos as $pO)
        {
            $idSP = $pO->idSucursalProducto;
            
            $sucursalProducto = Sucursal_producto::findOrFail($idSP);// where('idSucursal', '=',$idS)->get();
            
            if($sucursalProducto->idSucursal == $idS )
            {
                
                $producto = Producto::findOrFail($sucursalProducto->idProducto);
                
                $pO->nombre = $producto->nombre;
                $pO->codigoBarras = $producto->codigoBarras;
                $pO->idDepartamento = $producto->idDepartamento;
                array_push($productosS, $pO);
            }
        }
        return $productosS;//ProductosCaducidad::where('idSucursalProducto', '=',$id)->get();
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subproducto  $subproducto
     * @return \Illuminate\Http\Response
     */
    public function edit(Subproducto $subproducto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subproducto  $subproducto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subproducto $subproducto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subproducto  $subproducto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Subproducto::destroy($id);
        return redirect('puntoVenta/producto');
    }
}
