<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Notify extends Mailable
{
    use Queueable, SerializesModels;
     public $detalleCorreo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($detalleCorreo)
    {
        $this->detalleCorreo = $detalleCorreo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->detalleCorreo['tipo'] =='T'){
            return  $this->subject($this->detalleCorreo['Subject'])->view('notificaciones.two-factor');
            }
        if($this->detalleCorreo['tipo'] =='RE'){
               return  $this->subject($this->detalleCorreo['Subject'])->view('notificaciones.register-success');

        }
        if($this->detalleCorreo['tipo'] =='AU'){
               return  $this->subject($this->detalleCorreo['Subject'])->view('notificaciones.user-activate');

        }
          
    }
}
