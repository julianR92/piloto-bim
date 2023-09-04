<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Colectivo;
use App\Models\Area;
use App\Models\OfertaAcademica;
use App\Models\Instrumento;
use App\Models\Programa;
use App\Models\Auditoria;
use Carbon\Carbon;
use Illuminate\Validation\Rule; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;

class OfertaAcademicaController extends Controller
{
    public function index()
    {
        $areas = Area::all();
        return view('livewire.oferta_academica.index', compact('areas'));
    }

    public function areaOferta($id)
    {
        $area = Area::findOrFail($id);
        $ofertas = OfertaAcademica::select(['oferta_academica.id','oferta_academica.codigo', 'oferta_academica.grupo', 'oferta_academica.horario', 'oferta_academica.edad_min', 'oferta_academica.edad_max', 'oferta_academica.cupos', 'oferta_academica.fecha_audicion', 'oferta_academica.recomendacion', 'oferta_academica.vigencia', 'oferta_academica.estado', 'programas.programa', 'colectivos.colectivo', 'instrumentos.instrumento'])->join('programas', 'programas.id', '=','oferta_academica.programa_id')->leftjoin('colectivos', 'colectivos.id', '=','oferta_academica.colectivo_id')->leftjoin('instrumentos', 'instrumentos.id', '=','oferta_academica.instrumento_id')->where('oferta_academica.area_id', $id)->where('oferta_academica.vigencia', env('VIGENCIA_ACTUAL'))->orderBy('oferta_academica.id','desc')->get();
        return view('livewire.oferta_academica.oferta', compact('area', 'ofertas'));
    }

    public function ofertaNuevo($id)
    {
        $programas = Programa::where('estado', 1)->where('area_id', $id)->get();
        $colectivos = false;
        $area = Area::findOrFail($id);
        if ($id == 2) {
            $colectivos = Colectivo::all();
        }
        $grupos = Config::get('global.grupos');
        $titulo = 'Creación de oferta académica';
        $butttonMessage = 'Crear oferta';
        return view('livewire.oferta_academica.create', compact('titulo', 'butttonMessage', 'programas', 'colectivos','area','grupos'));
    }

    public function ofertaInstrumentos($id){
        $instrumentos = Instrumento::where('colectivo_id', $id)->get();
        if($instrumentos->count() > 0){
            return response()->json(['success' => true, 'datos' => $instrumentos]);
        }else{
            return response()->json(['success' => false, 'errors' => ['NO SE ENCONTRARON INSTRUMENTOS ASOCIADOS A ESTE COLECTIVO']]);
        }
    }

    public function store(Request $request)
    {
        $vigencia = env('VIGENCIA_ACTUAL');
        if($request->area_id == 2){ 
            $colectivo = ($request->colectivo_id)? $request->colectivo_id: null;  
            $instrumento = ($request->instrumento_id)? $request->instrumento_id: null; 
            $messages = [
                'programa_id.unique' => 'Esta oferta ya se encuentra creada con este mismo grupo, este mismo programa, este mismo colectivo y este mismo instrumento en la presente vigencia',
            ];
             $validator = Validator::make($request->all(), [
              
                "programa_id"=>['required',Rule::unique('oferta_academica')->where(function ($query) use ($request,$colectivo, $instrumento, $vigencia) { return $query->where('programa_id',$request->programa_id)->where('vigencia', $vigencia)->where('colectivo_id', $colectivo)->where('instrumento_id',$instrumento)->where('grupo', $request->grupo);
                })->ignore($request->id, 'id')],
                'colectivo_id' => 'required',
                'instrumento_id' => 'required',
                'area_id' => 'required',
                'codigo' => 'required',
                'grupo'=> 'required',
                'horario'=> 'required',
                'edad_min'=>'digits_between:1,2|required',
                'edad_max'=>'digits_between:1,2|required',
                'cupos'=>'digits_between:1,4|required',
                'fecha_audicion'=>'required',
                'lugar'=>'required',
                'salon'=>'required',
                'recomendacion'=>'required',
                'estado'=>'required',
                'audicion'=>'required',
                
                
            ], $messages);
        }else{
            $colectivo = null; 
            $instrumento = null;
            $messages = [
                'programa_id.unique' => 'Esta oferta ya se encuentra creada con este mismo grupo, este mismo programa en la presente vigencia',
            ];
            $validator = Validator::make($request->all(), [
                "programa_id"=>['required',Rule::unique('oferta_academica')->where(function ($query) use ($request,$vigencia) { return $query->where('programa_id',$request->programa_id)->where('vigencia', $vigencia)->where('grupo', $request->grupo);
                })->ignore($request->id, 'id')],           
                'area_id' => 'required',
                'codigo' => 'required',
                'grupo'=> 'required',
                'horario'=> 'required',
                'edad_min'=>'digits_between:1,2|required',
                'edad_max'=>'digits_between:1,2|required',
                'cupos'=>'digits_between:1,4|required',
                'fecha_audicion'=>'required',
                'lugar'=>'required',
                'salon'=>'required',
                'recomendacion'=>'required',
                'estado'=>'required',
                'audicion'=>'required',
            ], $messages);
            
        }
        
        if ($validator->fails()) {
            //devuelve errores a la vista
            return response()->json(['success' => false, 'errors' => $validator->errors()->all()]);
        }
        $validacion = OfertaAcademica::where('programa_id', $request->programa_id)
        ->where('grupo', $request->grupo)->where('vigencia', env('VIGENCIA_ACTUAL'))
        ->get();
        Carbon::setLocale('es');
        $data = Carbon::parse($request->fecha_audicion);
        $fecha_audicion = $data->dayName.' '.$data->format('d').' de '.$data->monthName. ' a las ' .$data->format('g:i A');
              

        if (!$request->id) {
            if ($validacion->count() > 0) {
                return response()->json(['success' => false, 'errors' => ['ESTE GRUPO YA SE ENCUENTRA REGISTRADO EN LA VIGENCIA ACTUAL']]);
            }

            $oferta_academica = new OfertaAcademica();
            $oferta_academica->area_id = $request->area_id;
            $oferta_academica->programa_id = $request->programa_id;
            $oferta_academica->colectivo_id = $colectivo;
            $oferta_academica->instrumento_id = $instrumento;
            $oferta_academica->codigo = $request->codigo;
            $oferta_academica->grupo = $request->grupo;
            $oferta_academica->horario = $request->horario;
            $oferta_academica->edad_min = $request->edad_min;
            $oferta_academica->edad_max = $request->edad_max;
            $oferta_academica->cupos = $request->cupos;
            $oferta_academica->fecha_audicion = $fecha_audicion;
            $oferta_academica->recomendacion = $request->recomendacion;
            $oferta_academica->vigencia = env('VIGENCIA_ACTUAL');
            $oferta_academica->lugar = $request->lugar;
            $oferta_academica->salon = $request->salon;
            $oferta_academica->estado = $request->estado;
            $oferta_academica->audicion = $request->audicion;
            $oferta_academica->date_format = $request->fecha_audicion;
            if ($oferta_academica->save()) {
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Creacion de Oferta Academica' . $oferta_academica->id . ' en la plataforma',
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],
                ]);

               return response()->json(['success' => true, 'message' => 'Oferta Academica Creada con exito']);
            }
        } else {
            $oferta_academica = OfertaAcademica::findOrFail($request->id);
            $oferta_academica->area_id = $request->area_id;
            $oferta_academica->programa_id = $request->programa_id;
            $oferta_academica->colectivo_id = $colectivo;
            $oferta_academica->instrumento_id = $instrumento;
            $oferta_academica->codigo = $request->codigo;
            $oferta_academica->grupo = $request->grupo;
            $oferta_academica->horario = $request->horario;
            $oferta_academica->edad_min = $request->edad_min;
            $oferta_academica->edad_max = $request->edad_max;
            $oferta_academica->cupos = $request->cupos;
            $oferta_academica->fecha_audicion = $fecha_audicion;
            $oferta_academica->recomendacion = $request->recomendacion;
            $oferta_academica->lugar = $request->lugar;
            $oferta_academica->salon = $request->salon;
            $oferta_academica->estado = $request->estado;
            $oferta_academica->audicion = $request->audicion;
            $oferta_academica->date_format = $request->fecha_audicion;
            if ($oferta_academica->save()) {
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Actualización de Oferta Academica' . $oferta_academica->id . ' en la plataforma',
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],
                ]);

               return response()->json(['success' => true, 'message' => 'Oferta Academica Actualizada con exito']);
            }
        }
    }

    public function edit($id){
        $datos = OfertaAcademica::findOrFail($id);
        $programas = Programa::where('estado', 1)->where('area_id', $datos->area_id)->get();
        $colectivos = false;
        $instrumentos = false;
        $area = Area::findOrFail($datos->area_id);
        if ($area->id == 2) {
            $colectivos = Colectivo::all();
            $instrumentos = Instrumento::where('colectivo_id', $datos->colectivo_id)->get();
           

        }
        
        $grupos = Config::get('global.grupos');
        $titulo = 'Actualización de Oferta';
        $butttonMessage = 'Actualizar Oferta';
        return view('livewire.oferta_academica.create', compact('titulo', 'butttonMessage', 'programas', 'colectivos','area','grupos', 'datos', 'instrumentos'));
      }


    public function delete($id)
    {
        $oferta = OfertaAcademica::findOrFail($id);

        $auditoria = Auditoria::create([
            'usuario' => auth()->user()->first_name,
            'correo' => auth()->user()->email,
            'observaciones' => 'Eliminación de eje ' . $oferta->id . ' en la plataforma',
            'direccion_ip' => $_SERVER['REMOTE_ADDR'],
        ]);
        $oferta->delete();

        return response()->json(['success' => true, 'message' => 'Oferta Academica Eliminada']);
    }
}
