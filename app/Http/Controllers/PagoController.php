<?php

namespace App\Http\Controllers;

use App\Models\Pago_venta;
use App\Models\Venta;
use App\Models\Venta_cliente;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    public function store(Request $request)
    {
        $monto = $request->input('monto');
        $idVentaCliente= $request->input('idVenta');
        $folio= $request->input('folio');
        $totalResta= $request->input('totalResta');
        $totalCompra = $request->input('totalCompra');
        $idSucEmp = session('idSucursalEmpleado');
        $pago = new Pago_venta;
        if ($monto == $totalResta) {
            if($monto > 0)
            {
            $pago->monto = $monto;
            $pago->idEmpSuc = $idSucEmp;
            $pago->idVentaCliente = $idVentaCliente;
            $pago->save();
            $credito['estado']= "pagado";
            $idVC = Venta_cliente::find($idVentaCliente);
            $idVC->update($credito);
            $actEstadoVenta['pago']=$totalCompra;
            $idVenta = Venta::find($folio);
            $idVenta->update($actEstadoVenta);
            }
        } elseif($monto > 0)
            {
            $pago->monto = $monto;
            $pago->idEmpSuc = $idSucEmp;
            $pago->idVentaCliente = $idVentaCliente;
            $pago->save();
            }
        return json_encode($pago);
    }
}
