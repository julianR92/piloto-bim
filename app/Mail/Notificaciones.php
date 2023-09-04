<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Notificaciones extends Mailable
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
        return  $this->subject($this->detalleCorreo['Subject'])->view('notificaciones.email');
    }
}
