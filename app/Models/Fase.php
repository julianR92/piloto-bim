<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Fase extends Model

{

    use HasFactory;
    protected $table = 'fases';
    protected $primaryKey = 'id';



    public function hitos()
    {
        return $this->hasMany(Hito::class, 'fase_id');
    }

    
    public function metodologia()
    {
        return $this->belongsTo(Metodologia::class);
    }
}

