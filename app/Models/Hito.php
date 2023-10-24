<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hito extends Model
{
    use HasFactory;
    protected $table = 'hitos';
    protected $primaryKey = 'id';

    
    public function indicadores()
    {
        return $this->hasMany(Indicador::class, 'hito_id');
    }
}


