<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['proveedores'] = Cliente::paginate();
        return view('Cliente.index',$datos);
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
        $datosCliente = request()->except('_token');
        Cliente::insert($datosCliente);
        
        return redirect('cliente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
      //  $datos['departamentos'] = Cliente::paginate();
        $datosD['d'] = Cliente::findOrFail($id);
        
        return view('Cliente.index',$datosD);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datosCliente = request()->except(['_token','_method']);
        Cliente::where('id','=',$id)->update($datosCliente);
        return redirect('cliente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)//Departamento $departamento)
    {
        Cliente::destroy($id);
        return redirect('cliente');
    }
    public function buscador(Request $request)
    {
        $datosConsulta['clienteB'] = Cliente::where("nombre",'like',$request->texto."%")->get();
        return view('cliente.form',$datosConsulta);
        //return $datosConsulta;
    }
}
