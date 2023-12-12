<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hito;
use App\Models\Fase;
use App\Models\Metodologia;
use App\Models\Indicador;
use App\Models\Auditoria;
use Illuminate\Validation\Rule; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HitosController extends Controller
{
    public function index()
    {
       
        //$fases = $this->cargarDatosFases();
        $metodologias = Metodologia::where('empresa_id', '=',auth()->user()->empresa_id)->where('estado', 1)->get();  
        $responsables = DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('roles.name', 'EMPRESA-RESPONSABLE')->where('users.empresa_id', '=',auth()->user()->empresa_id)
            ->select('users.*')
            ->get();
        $indicadores=Indicador::where('empresa_id', '=',auth()->user()->empresa_id)->get();  
        //return view('livewire.hitos.index', compact('fases','metodologias'));
        return view('livewire.hitos.index', compact('metodologias','responsables','indicadores'));
    }

    public function cargarDatosFases($medotologia_id)
    {
        $datos=Fase::where('empresa_id',auth()->user()->empresa_id)->where('metodologia_id',$medotologia_id)->get();
        return response()->json(['success' => true, 'datos' => $datos]);
    }

    public function cargarDatos() {   
       
        $empresa_id = auth()->user()->empresa_id ? auth()->user()->empresa_id : '%';
        /*
        $datos = Hito::with('indicadores')->select(['hitos.id', 'hitos.fase_id', 'hitos.nombre_hito', 'hitos.descripcion', 'fases.nombre_fase','users.first_name', 'users.last_name', 'users.id as user_id'])
        ->leftJoin('fases', 'fases.id', '=', 'hitos.fase_id')
        ->leftjoin('users', 'users.id', '=', 'hitos.responsable_id')
        ->where('fases.empresa_id','LIKE', $empresa_id)->orderBy('fases.id')->get();
        */
        $datos = Hito::with(['indicadores' => function ($query) {
            $query->where('hito_indicador.estado', '=', 1);
            }])
        ->select(['hitos.id', 'hitos.fase_id', 'hitos.nombre_hito', 'hitos.descripcion', 'fases.nombre_fase','users.first_name', 'users.last_name', 'users.id as user_id'])
        ->leftJoin('fases', 'fases.id', '=', 'hitos.fase_id')
        ->leftjoin('users', 'users.id', '=', 'hitos.responsable_id')
        ->where('fases.empresa_id', 'LIKE', $empresa_id)
        ->orderBy('fases.id')
        ->get();
        
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
            $hito->responsable_id  = $request->responsable_id;
            
            if ($hito->save()) {
                // Asociar los Indicadores al Hito a trav¨¦s de la relaci¨®n many-to-many
                $indicadoresData = [];
            
                foreach ($request->indicador_id as $indicadorId) {
                    // Aqu¨ª puedes establecer el valor de 'estado' seg¨²n tus necesidades
                    $estado = 1; // Por ejemplo, establecerlo como 'activo' por defecto
                    $indicadoresData[$indicadorId] = ['estado' => $estado];
                }
            
                $hito->indicadores()->attach($indicadoresData);
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
            $hito->responsable_id  = $request->responsable_id;
            if ($hito->save()) {
               
                 // Manejar la relaci¨®n many-to-many manualmente
                $indicadoresSeleccionados = $request->indicador_id;
            
                // Obtener los indicadores actuales asociados al hito
                $indicadoresActuales = $hito->indicadores()->pluck('indicadores.id')->toArray();
            
                // Identificar indicadores a agregar y quitar
                $indicadoresAgregar = array_diff($indicadoresSeleccionados, $indicadoresActuales);
                $indicadoresQuitar = array_diff($indicadoresActuales, $indicadoresSeleccionados);
            
                // Agregar nuevos indicadores con estado 1
                foreach ($indicadoresAgregar as $indicadorAgregar) {
                    $hito->indicadores()->attach($indicadorAgregar, ['estado' => 1]);
                }
            
                // Quitar indicadores con estado 0
                foreach ($indicadoresQuitar as $indicadorQuitar) {
                    $hito->indicadores()->updateExistingPivot($indicadorQuitar, ['estado' => 0]);
                }

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
        $hito = Hito::with('fase.metodologia')->findOrFail($id);
        
        // Obtener los indicadores asociados al Hito
        $indicadoresAsociados = $hito->indicadores()->wherePivot('estado', '=', 1)->pluck('indicadores.id')->toArray();
        
        return response()->json(['data' => $hito,'indAsocidos'=>$indicadoresAsociados]);
    }

    public function delete($id)
    {
        $hito = Hito::findOrFail($id);

        $auditoria = Auditoria::create([
            'usuario' => auth()->user()->first_name,
            'correo' => auth()->user()->email,
            'observaciones' => 'EliminaciÃ³n de hito ' . $hito->nombre_hito . ' en la plataforma',
            'direccion_ip' => $_SERVER['REMOTE_ADDR'],
        ]);
        $hito->delete();

        return response()->json(['success' => true, 'message' => 'Hito Eliminado']);
    }  
}
