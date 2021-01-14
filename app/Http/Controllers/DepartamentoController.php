<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    public function index()
    {
        $datos['departamentos'] = Departamento::paginate();
        return view('Departamento.index3',$datos);

    }

    public function index2()
    {
        $datosP= Departamento::all();
        $datos['departamentos'] = Departamento::paginate();
        //return view('Departamento.index2',$datos);
        return compact('datosP');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       // return view('Departamento.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datosDepartamento = request()->except('_token');
        Departamento::insert($datosDepartamento);
        
        return redirect('departamento');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function show(Departamento $departamento)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function edit($id)//Departamento $departamento)
    {
        $datos['departamentos'] = Departamento::paginate();
        $datosD['d'] = Departamento::findOrFail($id);
        
        return view('Departamento.index3',$datos,$datosD);
        //return redirect('departamento')->with('datosD',$datosD);
        //return redirect()->route('departamento', $datosD);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datosDepartamento = request()->except(['_token','_method']);
        Departamento::where('id','=',$id)->update($datosDepartamento);
        return redirect('departamento');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)//Departamento $departamento)
    {
        Departamento::destroy($id);
        return redirect('departamento');
    }

    public function buscador(Request $request)
    {
        $datosConsulta['departamentosB'] = Departamento::where("nombre",'like',$request->texto."%")->get();
        return view('Departamento.form',$datosConsulta);
        //return $datosConsulta;
    }
/*
    public function buscador2(Request $request)
    {
        $datosConsulta['departamentosB'] = Departamento::where("nombre",'like',$request->texto."%")->get();
        return view('Departamento.form2',$datosConsulta);
        //return $datosConsulta;
    }
    */
}
