<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\EnviarMailExistencia;
use Illuminate\Support\Facades\Mail;
use App\Models\Sucursal_producto;

class ExistenciaProductos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'existencia:productos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command para verificar la existencia de los productos';

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
        $productos = Sucursal_producto::whereColumn('minimoStock','>=','existencia')
        ->where('status', '=',1)->get();
        if(count($productos)>0)
        {
            //$titulo = "Este sera el titulo para existencia";
            //Mail::to('hzhm1997@gmail.com')->send(new EnviarMail($titulo,'existencia','PRODUCTOS BAJOS DE STOCK',$productos));//return 0;
            Mail::to('hzhm1997@gmail.com')->send(new EnviarMailExistencia($productos));
        }
    }
}
