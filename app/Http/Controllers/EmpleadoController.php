<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Departamento;
use Illuminate\Http\Request;

use Illuminate\Support\Arr;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('Empleado.index');
        //return view('Empleado.sesion1');
        //$datos['departamentos'] = Departamento::paginate();
     //  return view('header2');//,$datos);
     return view('Empleado.index2');
       // return view('Empleado.index');//,$datos);
    }
    /*
    public function index2()
    {
        
        return view('Empleado.sesion1');//,$datos);

    }*/
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
        $datosEmpleado = request()->except('_token','contra2');//,'apellidos','contra2','correo');
        $dato = ['status','alta'];
        $datosEmpleado = Arr::add($datosEmpleado,'status','alta');
        //$datosEmpleado = Arr::add($datosEmpleado, 'price', 100);
        //Empleado::insert($datosEmpleado);
        return $datosEmpleado;
        //return redirect('empleado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)//Empleado $empleado)
    {
        //$datos['empleados'] = Departamento::paginate();
        $datosEmpleado = Empleado::findOrFail($id);
        
        return view('Empleado.index',compact('datosEmpleado'));
        //return compact('datosEmpleado');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datosEmpleado = request()->except(['_token','_method']);
        Empleado::where('id','=',$id)->update($datosEmpleado);
        return redirect('empleado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Empleado::destroy($id);
        $dato = $request->validate(['status'=>'baja']);
        Empleado::where('id','=',$id)->update($dato);
        return redirect('empleado');
    }

    public function buscadorEmpleado(Request $request)
    {
        $datosConsulta['empleados'] = Empleado::where("nombre",'like',$request->texto."%")->get();
        return view('Empleado.empleados',$datosConsulta);
        //return $datosConsulta;
    }
}
