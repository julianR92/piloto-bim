<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoAdicional extends Model
{
    use HasFactory;
    protected $table = 'pago_adicionales';
    protected $primaryKey = 'id';
}
