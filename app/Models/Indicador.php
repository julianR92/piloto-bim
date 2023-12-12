<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicador extends Model
{
    use HasFactory;
    protected $table = 'indicadores';
    protected $primaryKey = 'id';
    
    public function hitos()
    {
        //return $this->belongsToMany(Hito::class, 'hito_indicador', 'indicador_id', 'hito_id');       
        return $this->belongsToMany(Hito::class)->withPivot('id');

    }
}
