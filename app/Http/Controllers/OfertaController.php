<?php

namespace App\Http\Controllers;

use App\Models\Oferta;
use App\Models\Sucursal_producto;
use App\Models\Sucursal_empleado;
use App\Models\Producto;
use Illuminate\Http\Request;

class OfertaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = ['verProducto','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        
        return view('Producto.oferta');
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
        $usuarios = ['crearProducto','modificarProducto','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        
        $idSP = $request['producto']['idSucursalProducto'];
        $cantidad = $request['producto']['cantidad'];
        $oferta = Oferta::where('idSucursalProducto','=',$idSP);
        $of = $oferta->get()->first();
        
        //return $oferta;
        if(isset($of))
        {
            //return 'pasa algo 0';
            $suma = $oferta->get()->first()->existencia + $cantidad;
            $oferta->update(['existencia' => $suma]);
            //$oferta->save();
            //return $suma;
        }
        else{
            //return 'pasa algo 1';
            Oferta::create([
                'idSucursalProducto' => $idSP,
                'existencia' => $cantidad
            ]);
            //return true;
        }
        $sucursalProducto = Sucursal_producto::findOrFail($idSP);//->update(['existencia' =>])
        $resta = $sucursalProducto->existencia - $cantidad;
        $sucursalProducto->update(['existencia' => $resta]);
        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Oferta  $oferta
     * @return \Illuminate\Http\Response
     */
    public function show($idS)
    {
        //$productos = Producto::all();
        //$sucursalProducto = Sucursal_producto::where('idSucursal', '=',$idS)->get();
        $usuarios = ['verProducto','crearProducto','modificarProducto','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        
        $productosOferta = Oferta::all();//where('idSucursalProducto','=',$sP->id)->get();
        
        $productosO = [];
        
        foreach($productosOferta as $pO)
        {
            $idSP = $pO->idSucursalProducto;
            
            $sucursalProducto = Sucursal_producto::findOrFail($idSP);// where('idSucursal', '=',$idS)->get();
            
            if($sucursalProducto->idSucursal == $idS)
            {
                
                $producto = Producto::findOrFail($sucursalProducto->idProducto);
                
                $pO->nombre = $producto->nombre;
                $pO->codigoBarras = $producto->codigoBarras;
                $pO->idDepartamento = $producto->idDepartamento;
                array_push($productosO, $pO);
            }
        }
        return $productosO;//ProductosCaducidad::where('idSucursalProducto', '=',$id)->get();
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Oferta  $oferta
     * @return \Illuminate\Http\Response
     */
    public function edit(Oferta $oferta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Oferta  $oferta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $usuarios = ['modificarProducto','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        
        if(isset($request['restar']))
        {
            $oferta = Oferta::where('idSucursalProducto','=',$id);//->update(['existencia'])
            $resta = $oferta->get()->first()->existencia - $request['restar'];
            $oferta->update(['existencia' => $resta]);
            return true;
        }
        return ':p';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Oferta  $oferta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Oferta $oferta)
    {
        //
    }
}
