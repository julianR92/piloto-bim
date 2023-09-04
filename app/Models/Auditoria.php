<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
    use HasFactory;
    protected $table = 'auditoria';
    protected $primaryKey = 'id';

    protected $fillable=[
        "usuario",
        "correo",
        "observaciones",
        "direccion_ip",      

    ];
}
