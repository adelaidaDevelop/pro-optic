<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['proveedores'] = Proveedor::paginate();
        return view('Proveedor.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
       // return view('Proveedor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $datosProveedor = request()->except('_token');
        Proveedor::insert($datosProveedor);
        
        return redirect('proveedor');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function show($proveedor)
    {
        if($proveedor == 'proveedor')
            return Proveedor::all();
        //$pagos = NULL;
        $proveedores = Proveedor::where('id','=',$idCompra)->get();
        //if(isset($pagos))
          //  return 'pagos no encontrados';
        //else
            return $pagos;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $datos['departamentos'] = Proveedor::paginate();
        $datosD['d'] = Proveedor::findOrFail($id);
        
        return view('Proveedor.index',$datosD);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datosProveedor = request()->except(['_token','_method']);
        Proveedor::where('id','=',$id)->update($datosProveedor);
        return redirect('proveedor');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)//Departamento $departamento)
    {
        Proveedor::destroy($id);
        return redirect('proveedor');
    }
    public function buscador(Request $request)
    {
        $datosConsulta['proveedorB'] = Proveedor::where("nombre",'like',$request->texto."%")->get();
        return view('Proveedor.form',$datosConsulta);
        //return $datosConsulta;
    }
}
