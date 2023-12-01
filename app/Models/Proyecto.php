<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;




class Proyecto extends Model

{

    use HasFactory;
    protected $table = 'proyectos';
    protected $primaryKey = 'id';

    public function metodologia()
    {
        return $this->belongsTo(Metodologia::class, 'metodologia_id', 'id');
    }

    public function seguimientos()
    {
        return $this->hasMany(Seguimiento::class, 'proyecto_id', 'id');
    }

    

   

}

