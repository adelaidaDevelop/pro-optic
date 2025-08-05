<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Producto;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    public function index()
    {
        $datos['departamentos'] = Departamento::paginate();
        return view('Departamento.index3',$datos);
    }

    public function index2()
    {
        $datosP= Departamento::all();
        $datos['departamentos'] = Departamento::paginate();
        return compact('datosP');
    }
    public function create()
    {
        return redirect('puntoVenta/departamento');
    }
    public function store(Request $request)
    {
        try{
        $datosDepartamento = request()->except('_token');
        Departamento::create($datosDepartamento);
        return redirect('puntoVenta/departamento')->withErrors(['mensajeConf' => 'ESTE DEPARTAMENTO SE AGREGO CORRECTAMENTE']);
        }catch(\Illuminate\Database\QueryException $e ){
            return redirect()->back()->withErrors(['mensaje' => 'ESTE DEPARTAMENTO YA EXISTE. AGREGA UNO DIFERENTE']);
        }
    }

    public function edit($id)
    {
        if($id == 0)
          {return redirect('puntoVenta/departamento');}
        $datos['departamentos'] = Departamento::paginate();
        $datosD['d'] = Departamento::findOrFail($id);
        return view('Departamento.index3',$datos,$datosD);
    }
    public function update(Request $request, $id)
    {
        try{
        $datosDepartamento = request()->except(['_token','_method']);
        $nombreN = $request['nombre'];
        $depto = Departamento::where('id','=',$id)->get()->first();
        $nombreAnt = $depto->nombre;
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

    public function destroy($id)
    {
        $actProdDepa = Producto::where('idDepartamento', '=',$id);
        $actDepa['idDepartamento'] = 1;
        $actProdDepa->update($actDepa);
        Departamento::destroy($id);
        return redirect('puntoVenta/departamento')->withErrors(['mensajeELIOk' => 'EL DEPARTAMENTO SE ELIMINO CORRECTAMENTE']);
    }

    protected function buscador(Request $request)
    {
        $datosConsulta['departamentosB'] = Departamento::where("nombre",'like',$request->texto."%")->where('id', '!=', 1)->get();
        return view('Departamento.form',$datosConsulta);
    }
}
