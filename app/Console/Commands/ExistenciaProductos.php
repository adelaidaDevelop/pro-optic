<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\EnviarMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Producto;

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
        $productos = Producto::whereColumn('minimo_stock','>=','existencia')->get();
        if(!empty($productos))
        {
            $titulo = "Este sera el titulo para existencia";
            Mail::to('hzhm1997@gmail.com')->send(new EnviarMail($titulo,'existencia','PRODUCTOS BAJOS DE STOCK',$productos));//return 0;
        }
    }
}
