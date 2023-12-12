<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Metodologia extends Model

{

    use HasFactory;
    protected $table = 'metodologia';
    protected $primaryKey = 'id';

    public function fases()
    {
        return $this->hasMany(Fase::class, 'metodologia_id');
    }
    
     public function proyectos()
    {
        return $this->hasMany(Proyecto::class, 'metodologia_id');
    }



}

