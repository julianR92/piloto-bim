<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Metodologia;
use App\Models\Auditoria;
use App\Models\Proyecto;
use Illuminate\Validation\Rule; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class ProyectosController extends Controller
{
    public function index()
    {    
        $empresa_id = auth()->user()->empresa_id ? auth()->user()->empresa_id : '%';
        $metodologias = Metodologia::where('empresa_id', $empresa_id)->where('estado', 1)->get();
        return view('livewire.proyectos.index', compact('metodologias'));
    }

    public function cargarDatos()
    {

        $empresa_id = auth()->user()->empresa_id ? auth()->user()->empresa_id : '%';
        $datos = Proyecto::select('proyectos.id', 'proyectos.descripcion', 'proyectos.estado','metodologia.descripcion as metodologia')
        ->join('metodologia', 'metodologia.id', '=','proyectos.metodologia_id')
        ->where('proyectos.empresa_id', 'LIKE', $empresa_id)
        ->orderBy('proyectos.id', 'ASC')
        ->get();
        return response()->json(['success' => true, 'datos' => $datos]);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'descripcion' => ['required',  Rule::unique('proyectos')->where(function ($query) use ($request) {
                return $query->where('empresa_id', auth()->user()->empresa_id)->where('metodologia_id',$request->metodologia_id);
            })->ignore($request->id, 'id')],
            'metodologia_id'=>'required',         
        ],[
            'descripcion.unique'=>'Ya tienes este proyecto con esta misma metodologia'
        ]);

        if ($validator->fails()) {
            //devuelve errores a la vista
            return response()->json(['success' => false, 'errors' => $validator->errors()->all()]);
        }
        $empresa_id = auth()->user()->empresa_id ? auth()->user()->empresa_id : null;
        if (!$request->id) {

            $datos = Metodologia::with('fases','fases.hitos', 'fases.hitos.indicadores')->where('id', $request->metodologia_id)->get();            

            try {

            DB::beginTransaction();

            $proyecto_id =  DB::table('proyectos')->insertGetId([
                'descripcion' => $request->descripcion,
                'empresa_id' => $empresa_id,
                'metodologia_id' => $request->metodologia_id,
                'estado' => 1,                
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')

            ]);


            $resultArray = [];
            foreach ($datos as $metodologia) {
                foreach ($metodologia['fases'] as $fase) {
                    foreach ($fase['hitos'] as $hito) {
                        foreach ($hito['indicadores'] as $indicador) {

                            $seguimiento_id =  DB::table('seguimiento')->insertGetId([
                                'proyecto_id' => $proyecto_id,
                                'metodologia_id' => $metodologia['id'],
                                'fase_id' => $fase['id'],
                                'hito_id' => $hito['id'],
                                'indicador_id' => $indicador['id'],
                                'fecha_inicio'=> date('Y-m-d'),
                                'estado'=> 1,
                                'porcentaje' => $indicador['valor'],            
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s')
                
                            ]);

                            //AUDITORIA

                            $auditoria = DB::table('auditoria')->insert(
                                [
                                    'usuario' => auth()->user()->first_name,
                                    'correo' => auth()->user()->email,
                                    'observaciones' => 'Creacion de Seguimiento # ' . $seguimiento_id . ' en la plataforma',
                                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],
                
                                ]
                            );
                           
                        }
                    }
                }
            }       
           

            $auditoria = DB::table('auditoria')->insert(
                [
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Creacion de proyecto # ' . $proyecto_id . ' en la plataforma con nombre de '.$request->descripcion,
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],

                ]
            );

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Proyecto Generado Exitosamente!']);

            // all good
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            return response()->json(['success' => false, 'errors' => ["Se ha producido un error $errorCode en la base de datos"], 'errorMessage' => $errorMessage]);
        } catch (\Exception $e) {

            $response = [ 'success' => false,
                'errors' =>[$e->getMessage()]
            ];
            return response()->json($response);

        }


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
        $datosSeguimiento = [];
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



