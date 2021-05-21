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
    protected function show($producto)
    {
        //$productos = Producto::all();
        //$sucursalProducto = Sucursal_producto::where('idSucursal', '=',$idS)->get();
    //    $usuarios = ['verProducto','crearProducto','modificarProducto','crearVenta','admin'];
    //    Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
    /*    
    $productos = Producto::where("nombre",'like',$producto."%")->get(['id', 'codigoBarras', 'nombre', 'idDepartamento']);//paginate(30,
        //['id', 'codigoBarras', 'nombre', 'idDepartamento'])->all();
        $productosBusqueda = [];
        //return $productos;
        for($i=0;$i< count($productos);$i++)
        {
            $sP = Sucursal_producto::where('idProducto', '=', $productos[$i]->id)
            ->where('idSucursal','=',session('sucursal'))->where('status','=',1)
            ->first(['id','costo','precio']);
            if(isset($sP))
            {
                //return $sP;
                $ss = Oferta::where('idSucursalProducto', '=', $sP->id)
                ->first(['existencia']);
                if(isset($ss))
                {
                    $productos[$i]->existencia = $ss->existencia;
                    //$productos[$i]->costo = $ss->costo;
                    $productos[$i]->precio = $sP->costo;
                    array_push($productosBusqueda,$productos[$i]);
                }
            }
            if(count($productosBusqueda) >= 30)
            return $productosBusqueda;
        }
        return $productosBusqueda;
        */
        $productosOferta = Oferta::all();//where('idSucursalProducto','=',$sP->id)->get();
        $productosO = [];
        foreach($productosOferta as $pO)
        {
            $idSP = $pO->idSucursalProducto;
            
            $sucursalProducto = Sucursal_producto::findOrFail($idSP);// where('idSucursal', '=',$idS)->get();
            
            if($sucursalProducto->idSucursal == session('sucursal'))//$idS)
            {
                //$producto = Producto::findOrFail($sucursalProducto->idProducto);
                $producto = Producto::where("nombre",'like',$producto."%")
                ->where('id','=',$sucursalProducto->idProducto)->get(['id', 'codigoBarras', 'nombre', 'idDepartamento'])->first();
                //return $producto->nombre;
                $pO->id = $sucursalProducto->idProducto;
                $pO->precio = $sucursalProducto->costo;
                //$pO->cantidad = $sucursalProducto->cantidad
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
        $usuarios = ['eliminarProducto','admin'];
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

    public function editarOferta(Request $request, $id)
    {
        $usuarios = ['eliminarProducto','admin'];
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
}
