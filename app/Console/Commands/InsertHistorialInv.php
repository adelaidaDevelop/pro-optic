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
       
 
    

            }
}
