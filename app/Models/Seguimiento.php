<?php
namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Seguimiento extends Model

{

    use HasFactory;
    protected $table = 'seguimiento';
    protected $primaryKey = 'id';
    
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }

    public function metodologia()
    {
        return $this->belongsTo(Metodologia::class, 'metodologia_id', 'id');
    }

    public function fase()
    {
        return $this->belongsTo(Fase::class, 'fase_id', 'id');
    }

    public function hito()
    {
        return $this->belongsTo(Hito::class, 'hito_id', 'id');
    }

    public function indicador()
    {
        return $this->belongsTo(Indicador::class, 'indicador_id', 'id');
    }

    public function detalles()
    {
        return $this->hasMany(SeguimientoDetalle::class, 'seguimiento_id', 'id');
    }
   

}

