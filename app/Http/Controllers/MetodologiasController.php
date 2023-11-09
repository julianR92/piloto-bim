<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Metodologia;
use App\Models\Servicio;
use App\Models\Precios;
use App\Models\Talla;
use App\Models\Auditoria;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule; 
use Illuminate\Support\Facades\Config;
use Carbon\Carbon;

class MetodologiasController extends Controller
{

    public function index()
    {    
        return view('livewire.metodologias.index');
    }

    public function cargarDatos()
    {

        $empresa_id = auth()->user()->empresa_id ? auth()->user()->empresa_id : '%';
        $datos = Metodologia::with('fases')
        ->where('empresa_id', 'LIKE', $empresa_id)->get();
        return response()->json(['success' => true, 'datos' => $datos]);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'descripcion' => ['required', 'max:100', 'required', Rule::unique('metodologia')->where(function ($query) use ($request) {
                return $query->where('empresa_id', auth()->user()->empresa_id);
            })->ignore($request->id, 'id')], 
            'estado'=> 'required'          
        ]);

        if ($validator->fails()) {
            //devuelve errores a la vista
            return response()->json(['success' => false, 'errors' => $validator->errors()->all()]);
        }
        $empresa_id = auth()->user()->empresa_id ? auth()->user()->empresa_id : null;
        if (!$request->id) {
            $metodologia = new Metodologia();    
            $metodologia->descripcion = $request->descripcion;
            $metodologia->estado = $request->estado;
            $metodologia->empresa_id  = $empresa_id;
            if ($metodologia->save()) {
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Creacion de metodologia ' . $request->descripcion . ' en la plataforma',
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],
                ]);

                return response()->json(['success' => true, 'message' => 'Metodologia Creada Exitosamente']);
            }
        } else {
            $metodologia = Metodologia::findOrFail($request->id);
            $metodologia->descripcion = $request->descripcion;
            $metodologia->estado = $request->estado;
            if ($metodologia->save()) {
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Actualizacion de metodologia ' . $request->descripcion . ' en la plataforma',
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],
                ]);

                return response()->json(['success' => true, 'message' => 'Metodologia Actualizada Exitosamente']);
            }
        }
    }

    public function edit($id)
    {
        $metodologia = Metodologia::findOrFail($id);
        return response()->json(['data' => $metodologia]);
    }
    public function structure($id)
    {
        $metodologia = Metodologia::with('fases','fases.hitos', 'fases.hitos.indicadores')->where('id', $id)->get();
        $nodeDataArray = [];
        $linkDataArray = [];

        foreach ($metodologia as $data) {
            $node = [
                "key" => "METODOLOGIA_" . $data["id"],
                "name" => $data["descripcion"],
                "color" => "turquoise",
            ];

            $nodeDataArray[] = $node;

            foreach ($data['fases'] as $fase) {

                $node = [
                    "key" => "FASE_" . $fase["id"],
                    "name" => $fase["nombre_fase"],
                    "color" => "lightgreen",
                ];

                $nodeDataArray[] = $node;


            foreach ($fase["hitos"] as $hito) {
                $node = [
                    "key" => "HITO_" . $hito["id"],
                    "name" => $hito["nombre_hito"],
                    "color" => "indigo",
                ];

                $nodeDataArray[] = $node;

                foreach ($hito["indicadores"] as $indicador) {
                    $node = [
                        "key" => "INDICADOR_" . $indicador["id"],
                        "name" => $indicador["nombre_indicador"] . ' %' . $indicador['valor'],
                        "color" => "goldenrod",
                    ];

                    $nodeDataArray[] = $node;
                }
            }
        }
    }
        $linkDataArray = [];

        foreach ($metodologia as $data) {
            $metodologiaKey = "METODOLOGIA_" . $data["id"];

            foreach ($data['fases'] as $fase) {
                $faseKey = "FASE_" . $fase["id"];
                $linkDataArray[] = [
                    "from" => $metodologiaKey,
                    "to" => $faseKey,
                ];

            foreach ($fase["hitos"] as $hito) {
                $hitoKey = "HITO_" . $hito["id"];
                $linkDataArray[] = [
                    "from" => $faseKey,
                    "to" => $hitoKey,
                ];

                foreach ($hito["indicadores"] as $indicador) {
                    $indicadorKey = "INDICADOR_" . $indicador["id"];
                    $linkDataArray[] = [
                        "from" => $hitoKey,
                        "to" => $indicadorKey,
                    ];
                }
            }
          }
        }
        return response()->json(['success' => true, 'links' => $linkDataArray, 'nodes' => $nodeDataArray]);
    }

    public function delete($id)
    {
        $metodologia = Metodologia::findOrFail($id);

        $auditoria = Auditoria::create([
            'usuario' => auth()->user()->first_name,
            'correo' => auth()->user()->email,
            'observaciones' => 'Eliminación de metodologia ' . $metodologia->descripcion . ' en la plataforma',
            'direccion_ip' => $_SERVER['REMOTE_ADDR'],
        ]);
        $metodologia->delete();

        return response()->json(['success' => true, 'message' => 'Metodologia Eliminada Exitosamente']);
    }
}




