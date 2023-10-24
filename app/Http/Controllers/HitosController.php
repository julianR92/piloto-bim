<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hito;
use App\Models\Fase;
use App\Models\Auditoria;
use Illuminate\Validation\Rule; 
use Illuminate\Support\Facades\Validator;

class HitosController extends Controller
{
    public function index()
    {
       
        $fases = $this->cargarDatosFases();
        return view('livewire.hitos.index', compact('fases'));
    }

    private function cargarDatosFases()
    {
        return Fase::where('empresa_id',auth()->user()->empresa_id)->get();
    }

    public function cargarDatos() {   
       
        $empresa_id = auth()->user()->empresa_id ? auth()->user()->empresa_id : '%';
        $datos = Hito::with('indicadores')->select(['hitos.id', 'hitos.fase_id', 'hitos.nombre_hito', 'hitos.descripcion', 'fases.nombre_fase'])->leftJoin('fases', 'fases.id', '=', 'hitos.fase_id')->where('fases.empresa_id','LIKE', $empresa_id)->orderBy('fases.id')->get();
        return response()->json(['success' => true, 'datos' => $datos]);
    }
 
   

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre_hito' => ['required','max:100','required',Rule::unique('hitos')->where(function ($query) use ($request) { return $query->where('empresa_id',auth()->user()->empresa_id)->where('fase_id',$request->fase_id);
            })->ignore($request->id, 'id')],
            'descripcion' => 'required|string|max:255|',
            'fase_id' => 'required'
        ]);


        if ($validator->fails()) {
            //devuelve errores a la vista
            return response()->json(['success' => false, 'errors' => $validator->errors()->all()]);
        }
        $empresa_id = auth()->user()->empresa_id ? auth()->user()->empresa_id : null;
        if (!$request->id) {
            $hito = new Hito();
            $hito->nombre_hito = $request->nombre_hito;
            $hito->descripcion = $request->descripcion;
            $hito->fase_id = $request->fase_id;
            $hito->empresa_id  = $empresa_id;      
            if ($hito->save()) {
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Creacion de hito ' . $request->nombre_hito . ' en la plataforma',
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],
                ]);

                return response()->json(['success' => true, 'message' => 'Hito Creado Exitosamente']);

            }
        } else {
            $hito = Hito::findOrFail($request->id);
            $hito->nombre_hito = $request->nombre_hito;
            $hito->descripcion = $request->descripcion;
            $hito->fase_id = $request->fase_id;             
            if ($hito->save()) {
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Actualizacion de Hito ' . $request->nombre_hito . ' en la plataforma',
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],
                ]);
                return response()->json(['success' => true, 'message' => 'Hito Editado Exitosamente']);

            }
        }
    }

    public function edit($id)
    {
        $hito = Hito::findOrFail($id);
        return response()->json(['data' => $hito]);
    }

    public function delete($id)
    {
        $hito = Hito::findOrFail($id);

        $auditoria = Auditoria::create([
            'usuario' => auth()->user()->first_name,
            'correo' => auth()->user()->email,
            'observaciones' => 'Eliminación de hito ' . $hito->nombre_hito . ' en la plataforma',
            'direccion_ip' => $_SERVER['REMOTE_ADDR'],
        ]);
        $hito->delete();

        return response()->json(['success' => true, 'message' => 'Hito Eliminado']);
    }  
}
