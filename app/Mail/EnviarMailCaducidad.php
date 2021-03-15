<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\Sucursal_producto;
use App\Models\Sucursal;
use App\Models\Producto;

class EnviarMailCaducidad extends Mailable
{
    use Queueable, SerializesModels;
    public $subject = 'PRODUCTOS PROXIMOS A CADUCAR';
    public $productosCaducidad;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($productosCaducidad)
    {
        $this->productosCaducidad = $productosCaducidad;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $productosCaducidad = $this->productosCaducidad;
        for($i = 0; $i < count($productosCaducidad); $i++)
        {
            $sP = Sucursal_producto::findOrFail($productosCaducidad[$i]->idSucursalProducto);
            $p = Producto::findOrFail($sP->idProducto); 
            $sucursal = Sucursal::findOrFail($sP->idSucursal);

            $productosCaducidad[$i]->codigoBarras = $p->codigoBarras;
            $productosCaducidad[$i]->nombre = $p->nombre;
            $productosCaducidad[$i]->idSucursal = $sucursal->id; 
        }
        $sucursales = Sucursal::all();
        for($i = 0; $i < count($sucursales); $i++)
        {
            $total = 0;
            foreach($productosCaducidad as $pc)
            {
                if($pc->idSucursal == $sucursales[$i]->id)
                {
                    $total++;
                }
            }
            $sucursales[$i]->total = $total;
        }
        return $this->view('Mail.productosCaducidad',compact('productosCaducidad','sucursales'));
    }
}
