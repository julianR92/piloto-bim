<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hito extends Model
{
    use HasFactory;
    protected $table = 'hitos';
    protected $primaryKey = 'id';

   
  
     public function fase()
    {
        return $this->belongsTo(Fase::class);
    }

    public function indicadores()
    {
        //return $this->belongsToMany(Indicador::class, 'hito_indicador', 'hito_id', 'indicador_id');
        return $this->belongsToMany(Indicador::class)->withPivot('id');

    }
}


