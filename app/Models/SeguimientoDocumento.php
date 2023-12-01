<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class SeguimientoDocumento extends Model

{

    use HasFactory;
    protected $table = 'seguimiento_detalle_documentos';
    protected $primaryKey = 'id';

    public function seguimientoDetalle()
    {
        return $this->belongsTo(SeguimientoDetalle::class, 'seguimiento_detalle_id', 'id');
    }

   

}

