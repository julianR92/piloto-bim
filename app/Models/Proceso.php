<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Eje;

class Proceso extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'procesos';
    protected $primaryKey = 'id';

    public function eje()
    {
        return $this->belongsTo(Eje::class);
    }
}
