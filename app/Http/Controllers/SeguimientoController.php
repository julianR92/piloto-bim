<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServicioAdicional;
use App\Models\Seguimiento;
use App\Models\Proyecto;
use App\Models\Auditoria;
use App\Models\Empresa;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SeguimientoController extends Controller
{

    public function index()
    {

        return view('livewire.seguimiento.index');
    }

    public function cargarDatos()
    {
        $responsableId = auth()->user()->id;
        $proyectos = Proyecto::where('estado', 1)->whereHas('seguimientos.fase', function ($query) use ($responsableId) {
            $query->where('responsable_id', $responsableId);
        })->with('seguimientos.detalles.documentos', 'metodologia', 'seguimientos.fase', 'seguimientos.hito', 'seguimientos.indicador')->get();
        return response()->json(['success' => true, 'datos' => $proyectos]);
    }



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'seguimiento_id' => 'required',
            "descripcion" => 'required|max:255',
            'valor' => 'required|numeric',


        ]);

        if ($validator->fails()) {
            //devuelve errores a la vista
            return response()->json(['success' => false, 'errors' => $validator->errors()->all()]);
        }

        $empresa = Empresa::findOrFail(auth()->user()->empresa_id);
        $nit = $empresa->nit;
        $proyecto = $request->proyecto_id;
        try {
            DB::beginTransaction();

            $seguimiento_detalle_id =  DB::table('seguimiento_detalle')->insertGetId([
                'seguimiento_id' => $request->seguimiento_id,
                'observacion' => $request->descripcion,
                'porcentaje_avance' => $request->valor,
                'fecha_registro' => date('Y-m-d'),
                'user_id' => auth()->user()->id,
                'estado' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')

            ]);

            if (isset($request->documentos)) {
                foreach ($request->documentos as $key => $archivo) {

                    $data = DB::table('seguimiento_detalle_documentos')
                    ->latest('id')
                    ->first();
                        if (isset($data)) {
                            $idDocumento = $data->id + 1;
                        } else {
                            $idDocumento = 1;
                        }
                        $extension = $archivo->extension();
                        $nombreArchivo = 'ANEXO_' . $seguimiento_detalle_id .'_' .$idDocumento.'_'. uniqid() . '.' . $extension;
                        $ruta = "storage/documentos_empresas/$nit/proyecto-$proyecto/$request->seguimiento_id/$seguimiento_detalle_id/$nombreArchivo";
                        // Mover el archivo a la carpeta de almacenamiento
                        $archivo->storeAs("documentos_empresas/$nit/proyecto-$proyecto/$request->seguimiento_id/$seguimiento_detalle_id/", $nombreArchivo);

                        $seguimiento_detalle_documentos_id =  DB::table('seguimiento_detalle_documentos')->insertGetId([
                            'seguimiento_detalle_id' => $seguimiento_detalle_id,
                            'nombre_doc' => $nombreArchivo,
                            'ruta' => $ruta,
                            'user_id' => auth()->user()->id,
                            'estado' => 0,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
            
                        ]);

                        $auditoria = DB::table('auditoria')->insert(
                            [
                                'usuario' => auth()->user()->first_name,
                                'correo' => auth()->user()->email,
                                'observaciones' => 'Creacion de Seguimiento detalle documento # ' . $seguimiento_detalle_documentos_id . ' en la plataforma',
                                'direccion_ip' => $_SERVER['REMOTE_ADDR'],
            
                            ]
                        );                      
                                               
                    
                }
            }
            $auditoria = DB::table('auditoria')->insert(
                [
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Creacion de seguimiento detalle # ' . $seguimiento_detalle_id . ' en la plataforma con nombre de '.$request->descripcion,
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],

                ]
            );
            $seguimiento = DB::table('seguimiento')->where('id', $request->seguimiento_id)->update([
                'estado'=>0
            ]);

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Proyecto Generado Exitosamente!']);

        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            return response()->json(['success' => false, 'errors' => ["Se ha producido un error $errorCode en la base de datos"], 'errorMessage' => $errorMessage]);
        } catch (\Exception $e) {

            $response = [
                'success' => false,
                'errors' => [$e->getMessage()]
            ];
            return response()->json($response);
        }


    }

    public function edit($id)
    {
        $servicio = ServicioAdicional::findOrFail($id);
        return response()->json(['data' => $servicio]);
    }

    public function delete($id)
    {
        $servicioA = ServicioAdicional::findOrFail($id);

        $auditoria = Auditoria::create([
            'usuario' => auth()->user()->first_name,
            'correo' => auth()->user()->email,
            'observaciones' => 'Eliminación de servicio Adicional ' . $servicioA->id . ' en la plataforma',
            'direccion_ip' => $_SERVER['REMOTE_ADDR'],
        ]);
        $servicioA->delete();

        return response()->json(['success' => true, 'message' => 'Servicio Adicional Eliminado']);
    }
}
