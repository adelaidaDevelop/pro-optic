<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Producto;
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
        return redirect('puntoVenta/departamento');

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
        $datosDepartamento['status'] = 1;
        Departamento::create($datosDepartamento);
        
        return redirect('puntoVenta/departamento');
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
        if($id == 0)
          return redirect('puntoVenta/departamento');
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
        return redirect('puntoVenta/departamento');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)//Departamento $departamento)
    {
        //if($id == 0)
          //  return back()->with(['departamento' => false]);
        //Producto::where('idDepartamento','=',$id)->update(['idDepartamento' => 0]);
        $actProdDepa = Producto::where('idDepartamento', '=',$id);
        $actDepa['idDepartamento'] = 1;
        $actProdDepa->update($actDepa);
       // $baja['status'] = 0;
       // $depa = Departamento::findOrFail($id);
       // $depa->update($baja);
        Departamento::destroy($id);
        return redirect('puntoVenta/departamento');
    }

    protected function buscador(Request $request)
    {
        $datosConsulta['departamentosB'] = Departamento::where("nombre",'like',$request->texto."%")->get();
        return view('Departamento.form',$datosConsulta);
        //return $datosConsulta;
    }
}
