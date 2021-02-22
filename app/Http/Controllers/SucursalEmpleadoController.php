<?php

namespace App\Http\Controllers;

use App\Models\Sucursal_empleado;
use Illuminate\Http\Request;

class SucursalEmpleadoController extends Controller
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
        $sucursal_empleado = new Sucursal_empleado;
        $sucursal_empleado->idSucursal = $request->input('idSucursal');
        $sucursal_empleado->idEmpleado = $request->input('idEmpleado');
        $sucursal_empleado->status = 'alta';
        $sucursal_empleado->save();
        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sucursal_empleado  $sucursal_empleado
     * @return \Illuminate\Http\Response
     */
    public function show($sucursal)//Sucursal_empleado $sucursal_empleado)
    {
        $sucursal_empleado = Sucursal_empleado::where('idSucursal','=',$sucursal)->get();
        //if($sucursal_empleado->count())
            return $sucursal_empleado;
        //return 'No hay empleados';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sucursal_empleado  $sucursal_empleado
     * @return \Illuminate\Http\Response
     */
    public function edit(Sucursal_empleado $sucursal_empleado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sucursal_empleado  $sucursal_empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)//Request $request, Sucursal_empleado $sucursal_empleado)
    {
        if($request->has('status'))
        {
            Sucursal_empleado::findOrFail($id)->update(['status' => $request->input('status')]);
            //where('id','=',$id)->update(['status' => $request->input('status')]);
            //return redirect('puntoVenta/empleado/'.$id.'/edit');
            return true;
        }
        return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sucursal_empleado  $sucursal_empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sucursal_empleado $sucursal_empleado)
    {
        //
    }
}
