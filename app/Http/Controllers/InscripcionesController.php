<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eje;
use App\Models\Proceso;
use App\Models\Area;
use App\Models\Programa;
use App\Models\Inscripcion;
use App\Models\Auditoria;
use Illuminate\Support\Facades\Validator;

class InscripcionesController extends Controller
{
    
    public function index(){
    
        
        $areas = Area::all(); 
        $inscripciones = Inscripcion::whereIn('estado',['INSCRITO','APROBADO'])->where('vigencia', env('VIGENCIA_ACTUAL'))->count();

     
        return view('livewire.inscripciones.index',compact('areas', 'inscripciones'));
        
       }
    
    public function areaInscripciones($id){
      
        $area = Area::findOrFail($id);          
        $inscripciones = Inscripcion::select(['inscripciones.id as id_inscripciones','inscripciones.estado', 'estudiantes.*', 'oferta_academica.codigo','oferta_academica.grupo', 'oferta_academica.horario', 'oferta_academica.cupos', 'programas.programa','colectivos.colectivo', 'instrumentos.instrumento'])->join('estudiantes','estudiantes.id','=','inscripciones.estudiante_id')->join('oferta_academica','oferta_academica.id','=','inscripciones.oferta_id')->join('programas','programas.id','=','oferta_academica.programa_id')->leftjoin('colectivos','colectivos.id','=','oferta_academica.colectivo_id')->leftjoin('instrumentos','instrumentos.id','=','oferta_academica.instrumento_id')->where('oferta_academica.area_id', $id)->where('inscripciones.vigencia', env('VIGENCIA_ACTUAL'))->whereIn('inscripciones.estado', ['INSCRITO','APROBADO'])->orderBy('inscripciones.id', 'desc')->get();
        $data_export = Inscripcion::select(['estudiantes.tipo_doc as tipo documento','estudiantes.documento as identificacion','estudiantes.nom_estudiante as nombre','estudiantes.ape_estudiante as apellidos','estudiantes.lugar_nacimiento as lugar de nacimiento','estudiantes.fecha_nacimiento as fecha de nacimiento','estudiantes.edad','estudiantes.genero','estudiantes.correo_electronico as email','estudiantes.direccion_residencia as direccion','estudiantes.estrato','estudiantes.municipio_residencia as municipio','estudiantes.barrio_vereda as barrio','estudiantes.comuna_corregimiento as comuna','estudiantes.telefono_fijo','estudiantes.telefono_movil as celular','estudiantes.orientacion_sexual','estudiantes.poblacion_etnica','estudiantes.poblacion_especiales','estudiantes.ocupacion','estudiantes.estudia_labora as estudia o labora?','estudiantes.sisben','estudiantes.puntaje_sisben','estudiantes.eps_afiliado as EPS','estudiantes.nivel_escolaridad','estudiantes.formacion_artistica','estudiantes.nombre_responsable as nombre responsable','estudiantes.documento_responsable as documento','estudiantes.telefono_responsable as telefono','estudiantes.direccion_responsable as direccion', 'oferta_academica.codigo','oferta_academica.grupo', 'oferta_academica.horario', 'oferta_academica.cupos', 'programas.programa','colectivos.colectivo', 'instrumentos.instrumento'])->join('estudiantes','estudiantes.id','=','inscripciones.estudiante_id')->join('oferta_academica','oferta_academica.id','=','inscripciones.oferta_id')->join('programas','programas.id','=','oferta_academica.programa_id')->leftjoin('colectivos','colectivos.id','=','oferta_academica.colectivo_id')->leftjoin('instrumentos','instrumentos.id','=','oferta_academica.instrumento_id')->where('oferta_academica.area_id', $id)->where('inscripciones.vigencia', env('VIGENCIA_ACTUAL'))->whereIn('inscripciones.estado', ['INSCRITO','APROBADO'])->orderBy('inscripciones.id', 'desc')->get();
        
                       
        return view('livewire.inscripciones.inscripciones',compact('area','inscripciones', 'data_export'));
    }

    public function programaProceso($id){
       
    $eje = Eje::findOrFail($id);
    $proceso = Proceso::findOrFail($eje->proceso_id);
    return response()->json(['data' => $proceso]);


    }

    public function store(Request $request){ 
        
        $validator = Validator::make($request->all(), [
            'programa' => 'required|max:150',
            'proceso_id' => 'required',
            'area_id' => 'required',
            'eje_id' => 'required',
            'duracion_programa'=>'required'
        ]);
    
        if($validator->fails()){
            //devuelve errores a la vista
         return response()->json([ 'success'=>false,'errors'=>$validator->errors()->all()]);
        }
        $validacion = Programa::where('area_id', $request->area_id)->where('programa',$request->programa)->get();
        
    
        if(!$request->id){
            if($validacion->count()>0){
                return response()->json(['success'=>false, 'errors'=>['ESTE PROGRAMA YA REGISTRADO']]);
            }
            $programas = new Programa();
            $programas->proceso_id  = $request->proceso_id;
            $programas->area_id  = $request->area_id;
            $programas->eje_id   = $request->eje_id;
            $programas->programa   = $request->programa;
            $programas->duracion_programa   = $request->duracion_programa;
            $programas->estado   = 1;
            $programas->vigencia   = env('VIGENCIA_ACTUAL');
             if($programas->save()){
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones'=> 'Creacion de Programa '. $request->programa .' en la plataforma',
                    'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           
        
                ]);
                
                $datos =Programa::select(['programas.programa', 'procesos.name as nombre_proceso', 'eje.descripcion as nombre_eje', 'programas.estado','programas.id'])->join('procesos','procesos.id','=','programas.proceso_id')->join('eje','eje.id','=','programas.eje_id')->where('programas.area_id', $request->area_id)->orderBy('programas.id', 'desc')->get();
                return response()->json(['success'=>true,'message'=>'Programa Creado','datos'=>$datos]);   
    
             }
        }else{

            $programas = Programa::findOrFail($request->id);
            $programas->proceso_id  = $request->proceso_id;
            $programas->area_id  = $request->area_id;
            $programas->eje_id   = $request->eje_id;
            $programas->programa   = $request->programa;
            $programas->duracion_programa   = $request->duracion_programa;
            if($programas->save()){
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones'=> 'Actualizacion de Programa '. $request->programa .' en la plataforma',
                    'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           
        
                ]);
                   $datos  =Programa::select(['programas.programa', 'procesos.name as nombre_proceso', 'eje.descripcion as nombre_eje', 'programas.estado','programas.id'])->join('procesos','procesos.id','=','programas.proceso_id')->join('eje','eje.id','=','programas.eje_id')->where('programas.area_id', $request->area_id)->orderBy('programas.id', 'desc')->get();
                   return response()->json(['success'=>true,'message'=>'Programa Actualizado','datos'=>$datos]);   
    
             }
    
        }
    
    
      }

      public function report(){
       $datos = Inscripcion::select(['estudiantes.tipo_doc as tipo documento','estudiantes.documento as identificacion','estudiantes.nom_estudiante as nombre','estudiantes.ape_estudiante as apellidos','estudiantes.lugar_nacimiento as lugar de nacimiento','estudiantes.fecha_nacimiento as fecha de nacimiento','estudiantes.edad','estudiantes.genero','estudiantes.correo_electronico as email','estudiantes.direccion_residencia as direccion','estudiantes.estrato','estudiantes.municipio_residencia as municipio','estudiantes.barrio_vereda as barrio','estudiantes.comuna_corregimiento as comuna','estudiantes.telefono_fijo','estudiantes.telefono_movil as celular','estudiantes.orientacion_sexual','estudiantes.poblacion_etnica','estudiantes.poblacion_especiales','estudiantes.ocupacion','estudiantes.estudia_labora as estudia o labora?','estudiantes.sisben','estudiantes.puntaje_sisben','estudiantes.eps_afiliado as EPS','estudiantes.nivel_escolaridad','estudiantes.formacion_artistica','estudiantes.nombre_responsable as nombre responsable','estudiantes.documento_responsable as documento','estudiantes.telefono_responsable as telefono','estudiantes.direccion_responsable as direccion', 'oferta_academica.codigo','oferta_academica.grupo', 'oferta_academica.horario', 'oferta_academica.cupos', 'programas.programa','colectivos.colectivo', 'instrumentos.instrumento'])->join('estudiantes','estudiantes.id','=','inscripciones.estudiante_id')->join('oferta_academica','oferta_academica.id','=','inscripciones.oferta_id')->join('programas','programas.id','=','oferta_academica.programa_id')->leftjoin('colectivos','colectivos.id','=','oferta_academica.colectivo_id')->leftjoin('instrumentos','instrumentos.id','=','oferta_academica.instrumento_id')->where('inscripciones.vigencia', env('VIGENCIA_ACTUAL'))->whereIn('inscripciones.estado', ['INSCRITO','APROBADO'])->orderBy('inscripciones.id', 'desc')->get();
        return response()->json(['data' => $datos, 'vigencia'=>env('VIGENCIA_ACTUAL')]);
      }

      public function changeState($id){
        
        $inscripcion = Inscripcion::findOrFail($id);        
        $inscripcion->estado = 'ANULADO';
        $inscripcion->save();
        $auditoria = Auditoria::create([
            'usuario' => auth()->user()->first_name,
            'correo' => auth()->user()->email,
            'observaciones'=> 'anulacion de inscripcion '. $id .' en la plataforma',
            'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           
    
        ]);

        return response()->json(['success'=>true,'message'=>'Inscripcion Anulada Desactivado']); 
        
        
      }

      public function delete($id){
        $programa = Programa::findOrFail($id);
        
     $auditoria = Auditoria::create([
         'usuario' => auth()->user()->first_name,
         'correo' => auth()->user()->email,
         'observaciones'=> 'Eliminación de eje '. $programa->programa .' en la plataforma',
         'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           
 
     ]);
     $programa->delete();
         
         return response()->json(['success'=>true,'message'=>'Programa Eliminado']); 
   }
}
