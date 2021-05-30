<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Detalle_venta;
use App\Models\Venta;
use App\Models\Sucursal_empleado;
use App\Models\historialInventario;

use Illuminate\Support\Facades\DB;



class InsertHistorialInv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'historial:inventario';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
  {
       
    $hoy = now()->toDateString();
        $datos = DB::table('detalle_ventas')
            ->join('ventas', 'detalle_ventas.idVenta', '=', 'ventas.id')
            ->join('sucursal_empleados', 'ventas.idSucursalEmpleado', '=', 'sucursal_empleados.id')
            ->where('ventas.fecha', '=', $hoy)
            ->select('sucursal_empleados.idSucursal as idSucu',  DB::raw('SUM(detalle_ventas.precioIndividual * detalle_ventas.cantidad) as sumaT'))
            ->groupBy('sucursal_empleados.idSucursal')
    ->get();
        //return $datos;
       // $array = (array) $datos;
        $array = json_decode(json_encode($datos), true);
    //return $array;
    foreach ($array as $datosInsertar) {
      //  return $datosInsertar;
      $historialV = new historialInventario;
      $historialV->totalInv = $datosInsertar['sumaT'];
      $historialV->fecha = $hoy;
      $historialV->idSucursal = $datosInsertar['idSucu'];
      $historialV->save();
        }
        return true;

 }
}
