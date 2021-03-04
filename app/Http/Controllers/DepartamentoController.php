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
        try{
        $datosDepartamento = request()->except('_token');
        $datosDepartamento['status'] = 1;
        Departamento::create($datosDepartamento);
        return redirect('puntoVenta/departamento')->withErrors(['mensajeConf' => 'ESTE DEPARTAMENTO SE AGREGO CORRECTAMENTE']);

        }catch(\Illuminate\Database\QueryException $e ){
            return redirect()->back()->withErrors(['mensaje' => 'ESTE DEPARTAMENTO YA EXISTE. AGREGA UNO DIFERENTE']);
        }
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
        try{
        $datosDepartamento = request()->except(['_token','_method']);
        $nombreN = $request['nombre'];
        $depto = Departamento::where('id','=',$id)->get()->first();
        $nombreAnt = $depto->nombre;
        //$nombreAnt;
        if( $nombreN == $nombreAnt)
        {
            return redirect()->back()->withErrors(['mensajeError' => 'PARA EDITAR DEBE MODIFICAR EL NOMBRE ']);
        }
        $depto->update($datosDepartamento);
        return redirect('puntoVenta/departamento')->withErrors(['mensajeConf' => 'ESTE DEPARTAMENTO SE EDITO CORRECTAMENTE']);
        }catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withErrors(['mensajeError' => 'ESTE DEPARTAMENTO YA EXISTE. INTENTE PONER UN NOMBRE DIFERENTE ']);
        }
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
        $datosConsulta['departamentosB'] = Departamento::where("nombre",'like',$request->texto."%")->where('id', '!=', 1)->get();
        return view('Departamento.form',$datosConsulta);
        //return $datosConsulta;
    }
}
