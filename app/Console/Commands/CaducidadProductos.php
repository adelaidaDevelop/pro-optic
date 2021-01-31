<?php

namespace App\Console\Commands;

use App\Mail\EnviarMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Command;


use App\Models\Productos_caducidad;
use App\Models\Producto;

class CaducidadProductos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'caducidad:productos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia un correo de prueba';

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
        //Mail::to('adhel1997@gmail.com')->send(new EnviarMail);////('Este es un correo de prueba'));
        $productosCaducidad = Productos_caducidad::all();
        $productos = Producto::all();
        $vista =  view('ProductosCaducidad.index',compact('productosCaducidad','productos'));
        Mail::to('hzhm1997@gmail.com')->send(new EnviarMail($vista));//return 0;
    }
}
