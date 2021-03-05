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
        $datosCliente['tipo']= 0; //0 para clientes deudores
        $datosCliente['idUsuario'] = 2;
        Cliente::insert($datosCliente);
        
        return redirect('puntoVenta/cliente');
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
            $nombre = $request['nombre'];
            $telefono = $request['telefono'];
            $domicilio = $request['domicilio'];
            $cliente = Cliente::findOrFail($id);
            $nombreAnt= $cliente->nombre;
            $telefonoAnt= $cliente->telefono;
            $domicilioAnt= $cliente->domicilio;
            if( $nombre == $nombreAnt && $telefono == $telefonoAnt && $domicilio == $domicilioAnt)
            {
                return redirect()->back()->withErrors(['mensajeError' => 'PARA EDITAR DEBE MODIFICAR AL MENOS UN ELEMENTO']);  
            }
            else{
            $cliente->update($datosCliente);
            return redirect('puntoVenta/cliente')->withErrors(['mensajeConf' => 'ESTE CLIENTE SE EDITO CORRECTAMENTE']);
            }
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
        return redirect('puntoVenta/cliente');
    }
    public function buscador(Request $request)
    {
        $datosConsulta['clienteB'] = Cliente::where("nombre",'like',$request->texto."%")->get();
        return view('cliente.form',$datosConsulta);
        //return $datosConsulta;
    }
    public function listaDeudor(){
        return view('ListaDeudor.index');
    }
}
