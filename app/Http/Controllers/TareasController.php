<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarea;
use Spatie\Permission\Models\Role;
use App\Models\Auditoria;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TareasController extends Controller
{

    public function load()
    {   
        $user = auth()->user();     
        $roles = $user->getRoleNames();    
        $firstRole = $roles->first();
        $empresa_id = auth()->user()->empresa_id ? auth()->user()->empresa_id : null;
        $tareas = Tarea::where('rol',$firstRole)->where('empresa_id',$empresa_id)->where('realizado', 0)->get(); 
        return response()->json(['success' => true, 'datos' =>$tareas ]);
    }  

    public function  doTask($id){
      
        $tarea = Tarea::where('id',$id)->update([
            'realizado' =>1,
            'realizado_por' =>auth()->user()->email
        ]);

        $auditoria = Auditoria::create([
            'usuario' => auth()->user()->first_name,
            'correo' => auth()->user()->email,
            'observaciones' => 'Tarea # ' . $id . ' realizada en la plataforma',
            'direccion_ip' => $_SERVER['REMOTE_ADDR'],
        ]);
        return response()->json(['success' => true]);



    }
   
      
   
  

 
   
}
