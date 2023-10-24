<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fase;
use App\Models\Empresa;
use App\Models\Auditoria;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FasesController extends Controller
{
    public function index()
    {
        return view('livewire.fases.index');
    }

    public function cargarDatos()
    {

        $empresa_id = auth()->user()->empresa_id ? auth()->user()->empresa_id : '%';
        $datos = Fase::with('hitos')->where('empresa_id', 'LIKE', $empresa_id)->get();
        return response()->json(['success' => true, 'datos' => $datos]);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre_fase' => ['required', 'max:100', 'required', Rule::unique('fases')->where(function ($query) use ($request) {
                return $query->where('empresa_id', auth()->user()->empresa_id);
            })->ignore($request->id, 'id')],
            'descripcion' => 'required|string|max:255|',
            'duracion' => 'required|numeric|max:999999'
        ]);

        if ($validator->fails()) {
            //devuelve errores a la vista
            return response()->json(['success' => false, 'errors' => $validator->errors()->all()]);
        }
        $empresa_id = auth()->user()->empresa_id ? auth()->user()->empresa_id : null;
        if (!$request->id) {
            $fase = new Fase();
            $fase->nombre_fase = $request->nombre_fase;
            $fase->descripcion = $request->descripcion;
            $fase->duracion = $request->duracion;
            $fase->empresa_id  = $empresa_id;
            if ($fase->save()) {
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Creacion de fase ' . $request->nombre_fase . ' en la plataforma',
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],
                ]);

                return response()->json(['success' => true, 'message' => 'Fase Creada Exitosamente']);
            }
        } else {
            $fase = Fase::findOrFail($request->id);
            $fase->nombre_fase = $request->nombre_fase;
            $fase->descripcion = $request->descripcion;
            $fase->duracion = $request->duracion;
            if ($fase->save()) {
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Actualizacion de fase ' . $request->nombre_fase . ' en la plataforma',
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],
                ]);

                return response()->json(['success' => true, 'message' => 'Fase Actualizada Exitosamente']);
            }
        }
    }

    public function edit($id)
    {
        $fase = Fase::findOrFail($id);
        return response()->json(['data' => $fase]);
    }
    public function structure($id)
    {
        $fase = Fase::with('hitos', 'hitos.indicadores')->where('id', $id)->get();
        $nodeDataArray = [];
        $linkDataArray = [];

        foreach ($fase as $data) {
            $node = [
                "key" => "FASE_" . $data["id"],
                "name" => $data["nombre_fase"],
                "color" => "lightblue",
            ];

            $nodeDataArray[] = $node;

            foreach ($data["hitos"] as $hito) {
                $node = [
                    "key" => "HITO_" . $hito["id"],
                    "name" => $hito["nombre_hito"],
                    "color" => "lightgreen",
                ];

                $nodeDataArray[] = $node;

                foreach ($hito["indicadores"] as $indicador) {
                    $node = [
                        "key" => "INDICADOR_" . $indicador["id"],
                        "name" => $indicador["nombre_indicador"] . ' %' . $indicador['valor'],
                        "color" => "lightyellow",
                    ];

                    $nodeDataArray[] = $node;
                }
            }
        }
        $linkDataArray = [];

        foreach ($fase as $data) {
            $faseKey = "FASE_" . $data["id"];

            foreach ($data["hitos"] as $hito) {
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
        return response()->json(['success' => true, 'links' => $linkDataArray, 'nodes' => $nodeDataArray]);
    }

    public function delete($id)
    {
        $fase = Fase::findOrFail($id);

        $auditoria = Auditoria::create([
            'usuario' => auth()->user()->first_name,
            'correo' => auth()->user()->email,
            'observaciones' => 'Eliminación de fase ' . $fase->nombre_fase . ' en la plataforma',
            'direccion_ip' => $_SERVER['REMOTE_ADDR'],
        ]);
        $fase->delete();

        return response()->json(['success' => true, 'message' => 'Fase Eliminada Exitosamente']);
    }
}
