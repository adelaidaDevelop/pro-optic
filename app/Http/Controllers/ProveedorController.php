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
        
        return redirect('puntoVenta/proveedor');
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
        if($proveedor == 'baja')
        {
            return Proveedor::where('status', '=', false)->get();
        }
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
        $datosD['d'] = Proveedor::findOrFail($id);
        if($datosD['d']->status == true)
            return view('Proveedor.index',$datosD);
        return redirect('/puntoVenta/proveedor');
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
        if($request->has('status'))
        {
            Proveedor::findOrFail($id)->update(['status' => true ]);
            //where('id','=',$id)->update(['status' => $request->input('status')]);
            //return redirect('puntoVenta/empleado/'.$id.'/edit');
            return true;
        }
        $datosProveedor = request()->except(['_token','_method']);
        Proveedor::where('id','=',$id)->update($datosProveedor);
        return redirect('puntoVenta/proveedor');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)//Departamento $departamento)
    {
        //Proveedor::destroy($id);
        Proveedor::findOrFail($id)->update(['status' => false]);
        return redirect('/puntoVenta/proveedor');
    }
    public function buscador(Request $request)
    {
        $datosConsulta['proveedorB'] = Proveedor::where("nombre",'like',$request->texto."%")->get();
        return view('Proveedor.form',$datosConsulta);
        //return $datosConsulta;
    }
}
