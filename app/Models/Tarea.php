<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;
    protected $table = 'tareas_pendientes';
    protected $primaryKey = 'id';

    protected $fillable=[
        "tarea",
        "de_user",
        "rol",
        "empresa_id", 
        "realizado",
        "realizado_por"     

    ];
}
