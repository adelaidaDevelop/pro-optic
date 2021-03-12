<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\Sucursal_producto;
use App\Models\Sucursal;
use App\Models\Producto;

class EnviarMailExistencia extends Mailable
{
    use Queueable, SerializesModels;
    public $subject = 'PRODUCTOS BAJOS DE EXISTENCIA';
    public $sucursalProductos;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($productos)
    {
        $this->sucursalProductos = $productos;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('view.name');
        //$productos = Producto::all();
        $sucursalProductos = $this->sucursalProductos;
        for($i = 0; $i < count($sucursalProductos); $i++)
        {
            $producto = Producto::findOrFail($sucursalProductos[$i]->idProducto);
            $sucursalProductos[$i]->codigoBarras = $producto->codigoBarras;
            $sucursalProductos[$i]->nombre = $producto->nombre;
            
        }
        $sucursales = Sucursal::all();
        for($i = 0; $i < count($sucursales); $i++)
        {
            $sP = Sucursal_producto::whereColumn('minimoStock','>=','existencia')
            ->where('status', '=',1)->where('idSucursal', '=',$sucursales[$i]->id)->get();
            $sucursales[$i]->total = count($sP);
        }
        return $this->view('Mail.productosExistencia',compact('sucursalProductos','sucursales'));
    }
}
