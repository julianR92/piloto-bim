<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MallaDetalle extends Model
{
    use HasFactory;
    protected $table = 'malla_detalle';
    protected $primaryKey = 'id';
}
