<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use App\Models\Sucursal_empleado;
use Illuminate\Http\Request;

class SucursalController extends Controller
{
    public function index()
    {
        return view('auth.newLogin');
    }
    public function darAltaSucursal($id){
        $sucursal = Sucursal::findOrFail($id);
        $dato['status'] = 1;
        $sucursal->update($dato);
        return redirect('puntoVenta/administracion');
    }
    public function sucu_inactivas(){

        return Sucursal::where('status', '=', 0)->get();
    }
    public function show($id)//Sucursal $sucursal)
    {
        if($id == 'sucursales')
        {
            return Sucursal::all();
        }
    }
    public function destroy($id)//Sucursal $sucursal)
    {
        $sucursales = Sucursal::where('status','=', 1)->get();
        if(count($sucursales)>1)
        {
            try{
                Sucursal::destroy($id);
            }
            catch (\Illuminate\Database\QueryException $e){
            $sucursal['status'] =0;
            $suc2 = Sucursal::findOrFail($id);
            $suc2->update($sucursal);
            }
            return redirect('puntoVenta/administracion');
        }
        else  {
            return redirect()->back()->withErrors(['mensaje' => 'ESTA SUCURSAL ES LA UNICA ACTIVA Y NO SE PUEDE ELIMINAR']);
        }
    }

    public function destroy2($id)//Sucursal $sucursal)
    {
        $sucursales = Sucursal::where('status','=', 1)->get();
        if(count($sucursales)>1) {
            $sucursalAux = new Sucursal;
        $sucursalAux->direccion = 'a12s3d5f6g5d4s5dde89';
        $sucursalAux->telefono = '1234567891';
        $sucursalAux->status = 1;
        $sucursalAux->save();
            try{
                Sucursal_empleado::where('idSucursal','=',$id)->where('idEmpleado','=',1)
                ->update(['idSucursal' => $sucursalAux->id]);
                Sucursal::destroy($id);
                Sucursal_empleado::where('idSucursal','=',$sucursalAux->id)
                ->where('idEmpleado','=',1)->delete();
                Sucursal::destroy($sucursalAux->id);
                return true;
             }
            catch (\Illuminate\Database\QueryException $e)
                {
                    $sE = Sucursal_empleado::where('idSucursal','=',$sucursalAux->id)->where('idEmpleado','=',1)
                    ->update(['idSucursal' => $id]);
                    Sucursal::destroy($sucursalAux->id);
                    return false;
                 }
           }
        else  {
            return  'ESTA SUCURSAL ES LA UNICA ACTIVA Y NO SE PUEDE ELIMINAR';
        }
    }
    public function bajaSucursal($id){
        $sucursal['status'] =0;
        $suc2 = Sucursal::findOrFail($id);
        $suc2->update($sucursal);
        return true;
    }
}
