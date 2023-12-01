<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeguimientoDetalle extends Model
{
    use HasFactory;
    protected $table = 'seguimiento_detalle';
    protected $primaryKey = 'id';

    public function seguimiento()
    {
        return $this->belongsTo(Seguimiento::class, 'seguimiento_id', 'id');
    }

    public function documentos()
    {
        return $this->hasMany(SeguimientoDocumento::class, 'seguimiento_detalle_id', 'id');
    }
}
