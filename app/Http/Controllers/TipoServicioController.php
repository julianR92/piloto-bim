<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eje;
use App\Models\Proceso;
use App\Models\TipoServicio;
use Illuminate\Support\Facades\DB;
use App\Models\Auditoria;
use Illuminate\Support\Facades\Validator;

class TipoServicioController extends Controller
{
    public function index()
    {
        $tipos = $this->cargarDatos();
        return view('livewire.tipo-servicio.index', compact('tipos'));
    }

    private function cargarDatos()
    {
        return TipoServicio::select('id', 'tipo_servicio')
            ->orderBy('id', 'desc')
            ->get();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tipo_servicio' => 'required|max:30|unique:tipo_servicio,tipo_servicio,'. $request->id,
        ]);

        if ($validator->fails()) {
            //devuelve errores a la vista
            return response()->json(['success' => false, 'errors' => $validator->errors()->all()]);
        }

        if (!$request->id) {
            $tipo = new TipoServicio();
            $tipo->tipo_servicio = $request->tipo_servicio;
            if ($tipo->save()) {
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Creacion de tipo de servicio ' . $request->tipo_servicio . ' en la plataforma',
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],
                ]);

                $datos = $this->cargarDatos();
                return response()->json(['success' => true, 'message' => 'Tipo de Servcio Creado', 'datos' => $datos]);
            }
        } else {
            $tipo = TipoServicio::findOrFail($request->id);
            $tipo->tipo_servicio = $request->tipo_servicio;
            if ($tipo->save()) {
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Actualizacion de tipo de servicio ' . $request->tipo_servicio . ' en la plataforma',
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],
                ]);
                $datos = $this->cargarDatos();
                return response()->json(['success' => true, 'message' => 'Tipo de Servcio Actualizado', 'datos' => $datos]);
            }
        }
    }

    public function edit($id)
    {
        $tipo = TipoServicio::findOrFail($id);
        return response()->json(['data' => $tipo]);
    }

    public function delete($id)
    {
        $tipo = TipoServicio::findOrFail($id);

        $auditoria = Auditoria::create([
            'usuario' => auth()->user()->first_name,
            'correo' => auth()->user()->email,
            'observaciones' => 'Eliminación de Tipo de Servicio ' . $tipo->tipo_servicio . ' en la plataforma',
            'direccion_ip' => $_SERVER['REMOTE_ADDR'],
        ]);
        $tipo->delete();

        return response()->json(['success' => true, 'message' => 'Tipo de Servicio Eliminado']);
    }
}
