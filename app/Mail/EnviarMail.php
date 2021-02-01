<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\Productos_caducidad;
use App\Models\Producto;

class EnviarMail extends Mailable
{
    use Queueable, SerializesModels;


    public $subject = 'PRODUCTOS CADUCADOS';
    public $tipomsg;
    public $asunto;
    public $datos;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($titulo,$tipomsg,$asunto,$datos)
    {
        $this->subject = $titulo;
        $this->tipomsg = $tipomsg;
        $this->asunto = $asunto;
        $this->datos = $datos;
        //$this->view = $msg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->tipomsg == 'caducidad')
        {
            $productosCaducidad = Productos_caducidad::all();
            $productos = Producto::all();
            return $this->view('ProductosCaducidad.index',compact('productosCaducidad','productos'));
        }
        if($this->tipomsg == 'existencia')
        {   $productos = $this->datos;//Producto::whereColumn('minimo_stock','>=','existencia')->get();
            //$productosCaducidad = Productos_caducidad::all();
            //$productos = Producto::all();
            return $this->view('Mail.productosExistencia',compact('productos'),$this->asunto);
        }
        
        //return $this->view('Mail.index');
        //return $this->redirect('producto');
        ///return $this->view;
    }
}
