<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AudicionDetalle extends Model
{
    use HasFactory;
    protected $table = 'audicion_detalle';
    protected $primaryKey = 'id';
}
