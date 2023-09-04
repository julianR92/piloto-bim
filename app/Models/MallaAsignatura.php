<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MallaAsignatura extends Model
{
    use HasFactory;
    protected $table = 'malla_asignatura';
    protected $primaryKey = 'id';
}
