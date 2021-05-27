<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Detalle_venta;
use App\Models\Venta;
use App\Models\Sucursal_empleado;


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
        /*
        $hoy = now()->toDateString()();
        DB::table('Detalle_venta')
        ->join('venta', function ($join) {
            $join->on('Detalle_venta.idVenta', '=', 'venta.id')
            ->join('Sucursal_empleado', function ($join) {
                $join->on('venta.idSucursalEmpleado', '=', 'Sucursal_empleado.id')
                ->select('Sucursal_empleado.idSucursal', DB::raw('SUM(dv.precioIndividual * dv.cantidad) as sumaT'))
                 ->where('venta.fecha', '=', $hoy)
                 ->groupBy('Sucursal_empleado.idSucursal')
                
        
        ->get();

  $idSuc = Detalle_venta

 $idSuc= sucEmp.idSucursal from detalle_venta dv inner join venta v on dv.idVenta = v.id INNER JOIN sucursal_empleados sucEmp on v.idSucursalEmpleado = sucEmp.id
  GROUP BY sucEmp.idSucursal; 
  
select @totalV:= sum( dv.precioIndividual * dv.cantidad) as totalV
from detalle_ventas dv inner join ventas v on dv.idVenta = v.id INNER JOIN sucursal_empleados sucEmp on v.idSucursalEmpleado = sucEmp.id
  GROUP BY sucEmp.idSucursal; 

INSERT INTO `historial_inventarios` (`id`, `totalInv`, `fecha`, `created_at`, `updated_at`) VALUES (NULL, @totalV, now(), @idSuc, now());
  */
            }
}
