<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hito;
use App\Models\Fase;
use App\Models\Auditoria;
use App\Models\Indicador;
use Illuminate\Validation\Rule; 
use Illuminate\Support\Facades\Validator;

class IndicadoresController extends Controller
{

    public function index()
    {
        $hitos = $this->cargarDatosHitos();
        return view('livewire.indicadores.index', compact('hitos'));
    }

    private function cargarDatosHitos()
    {
        return Hito::select('hitos.id', 'hitos.nombre_hito', 'hitos.descripcion', 'fases.nombre_fase')->leftJoin('fases', 'fases.id', '=','hitos.fase_id')->where('hitos.empresa_id', auth()->user()->empresa_id)->get();
    }

    public function cargarDatos()
    {

        $empresa_id = auth()->user()->empresa_id ? auth()->user()->empresa_id : '%';
        $datos = Indicador::select(['indicadores.id','indicadores.nombre_indicador', 'indicadores.descripcion', 'indicadores.valor','indicadores.formula','indicadores.periocidad','indicadores.bueno','indicadores.regular','indicadores.bajo'])->where('indicadores.empresa_id', 'LIKE', $empresa_id)->get();
        return response()->json(['success' => true, 'datos' => $datos]);
    }



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre_indicador' => ['required', 'max:100', 'required', Rule::unique('indicadores')->where(function ($query) use ($request) {
                return $query->where('empresa_id', auth()->user()->empresa_id)->where('nombre_indicador', $request->nombre_indicador);
            })->ignore($request->id, 'id')],
            'descripcion' => 'required|string|max:255|',
            'valor'=>'required|numeric|max:999',
            'formula'=>'required|string|max:100',
            'periocidad'=>'required|string|max:50',
            'bueno'=>'required|string|max:10',
            'regular'=>'required|string|max:10',
            'bajo'=>'required|string|max:10'
        ]);

        if ($validator->fails()) {
            //devuelve errores a la vista
            return response()->json(['success' => false, 'errors' => $validator->errors()->all()]);
        }
        $empresa_id = auth()->user()->empresa_id ? auth()->user()->empresa_id : null;
        $validacion = array();        

        if (!$request->id) {
            /*
            $validacion = $this->validacionPorcentajes($request->hito_id, $request->valor);        
            if($validacion['status']){
                return response()->json(['success' => false, 'errors' => [$validacion['mensaje']]]);
            }
            */
            //$validacionMessage = ($validacion['mensaje']) ? $validacion['mensaje'] : '';
            $validacionMessage="";
            $indicador = new Indicador();
            $indicador->nombre_indicador = $request->nombre_indicador;
            $indicador->descripcion = $request->descripcion;
            $indicador->valor = $request->valor;
            $indicador->formula = $request->formula;
            $indicador->periocidad = $request->periocidad;
            $indicador->bueno = $request->bueno;
            $indicador->regular = $request->regular;
            $indicador->bajo = $request->bajo;
            $indicador->empresa_id  = $empresa_id;
            if ($indicador->save()) {
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Creacion de indicador ' . $request->nombre_indicador . ' en la plataforma',
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],
                ]);

                return response()->json(['success' => true, 'message' => "Indicador Creado  $validacionMessage"]);
            }
        } else {
            /*
            $validacion = $this->validacionPorcentajesEdit($request->hito_id, $request->valor, $request->id);        
            if($validacion['status']){
                return response()->json(['success' => false, 'errors' => [$validacion['mensaje']]]);
            }
            */
            //$validacionMessage = ($validacion['mensaje']) ? $validacion['mensaje'] : '';
            $validacionMessage="";
            $indicador = Indicador::findOrFail($request->id);
            $indicador->nombre_indicador = $request->nombre_indicador;
            $indicador->descripcion = $request->descripcion;
            $indicador->valor = $request->valor;
            $indicador->formula = $request->formula;
            $indicador->periocidad = $request->periocidad;
            $indicador->bueno = $request->bueno;
            $indicador->regular = $request->regular;
            $indicador->bajo = $request->bajo;
            if ($indicador->save()) {
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Actualizacion de Indicador ' . $request->nombre_indicador . ' en la plataforma',
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],
                ]);
                return response()->json(['success' => true, 'message' => "Indicador Actualizado, $validacionMessage"]);
            }
        }
    }

    public function edit($id)
    {
        $indicador = Indicador::findOrFail($id);
        return response()->json(['data' => $indicador]);
    }

    public function delete($id)
    {
        $indicador = Indicador::findOrFail($id);

        $auditoria = Auditoria::create([
            'usuario' => auth()->user()->first_name,
            'correo' => auth()->user()->email,
            'observaciones' => 'Eliminación de indicador ' . $indicador->nombre_indicador . ' en la plataforma',
            'direccion_ip' => $_SERVER['REMOTE_ADDR'],
        ]);
        $indicador->delete();

        return response()->json(['success' => true, 'message' => 'Indicador Eliminado']);
    }

    /*
    function validacionPorcentajes($hito_id, $porcentaje){

        $dataIndi = Indicador::where('hito_id', $hito_id)->get();
        $contador = 0;
        $resta = 0;
    
          if($dataIndi->count()==0) {
            $resta = 100 - $porcentaje;
            $data = ['status'=>false, 'substract' => $resta, 'mensaje'=>" Te falta $resta% para completar el total de los indicadores en este Hito" ];
            return $data;
        }else if($dataIndi->count()>0){
            foreach($dataIndi as $indicador){
                $contador  = $contador + $indicador->valor;
            }
            $contador = $contador + $porcentaje;
            $resta = 100 - $contador;
            if($contador > 100){
                $data = ['status'=>true, 'substract' => $resta, 'mensaje'=>'La suma de porcentajes no pueden superar el 100%'];
                return $data;
            }else if($contador == 100){
                $data = ['status'=>false, 'substract' => $resta, 'mensaje'=>" Tu Hito esta completao al 100%"];
                return $data;            
            }else{
                $data = ['status'=>false, 'substract' => $resta, 'mensaje'=>"Te falta $resta% para completar el total de los indicadores en este Hito"];
                return $data;
            }
        }
    }
    
    function validacionPorcentajesEdit($hito_id, $porcentaje, $id = null){
        
        $dataIndi = Indicador::where('hito_id', $hito_id)->get();
        $indi = Indicador::findOrFail($id);
        $contador = 0;
        $resta = 0;
    
          if($dataIndi->count()==0) {
            $resta = 100 - $porcentaje;
            $data = ['status'=>false, 'substract' => $resta, 'mensaje'=>" Te falta $resta% para completar el Hito" ];
            return $data;
        }else if($dataIndi->count()>0){
            foreach($dataIndi as $indicador){
                $contador  = $contador + $indicador->valor;
            }
            
            $contador = ($contador + $porcentaje) - $indi->valor;
            $resta = 100 - $contador;
            if($contador > 100){
                $data = ['status'=>true, 'substract' => $resta, 'mensaje'=>'La suma de porcentajes no pueden superar el 100%'];
                return $data;
            }else if($contador == 100){
                $data = ['status'=>false, 'substract' => $resta, 'mensaje'=>" Tu Hito esta completo al 100%"];
                return $data;            
            }else{
                $data = ['status'=>false, 'substract' => $resta, 'mensaje'=>"Te falta $resta% para completar el total del Hito"];
                return $data;
            }
        }
    }
    */
    
}
