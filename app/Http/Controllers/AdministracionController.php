<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Sucursal;

class AdministracionController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        return view('Administracion.index');
    }

    public function empleados()
    {
        return redirect('puntoVenta/empleado');
    }

    public function edit($id)
    {
        $datosD['d'] = Sucursal::findOrFail($id);
        $sucursal = Sucursal::findOrFail($id);
        return view('Administracion.index',$datosD,compact('sucursal'));
    }
    public function store(Request $request)
    {
        $datosCliente = request()->except('_token');
        $datosCliente['status'] = 1;
        Sucursal::insert($datosCliente);
        
        return redirect('puntoVenta/administracion');
    }

    public function update(Request $request, $id)
    {
        $datosCliente = request()->except(['_token','_method']);
        Sucursal::where('id','=',$id)->update($datosCliente);
        return redirect('puntoVenta/administracion');
    }

    public function destroy($id)//Departamento $departamento)
    {
        $sucursal['status'] =0;
        $suc2 = Sucursal::findOrFail($id);
        $suc2->update($sucursal);
      //  Sucursal::destroy($id);
    //  Sucursal::where('id','=',$id)->update($datosCliente);
        return redirect('puntoVenta/administracion');
    }

    public function buscador(Request $request)
    {
        $datosConsulta['clienteB'] = Sucursal::where("direccion",'like',$request->texto."%")->get();
        return view('Administracion.form',$datosConsulta);
        //return $datosConsulta;
    }

    public function sucursales()
    {
        return redirect('puntoVenta/sucursal');
    }
}
