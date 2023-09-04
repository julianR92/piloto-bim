<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoServicio;
use App\Models\Auditoria;
use App\Models\Servicio as Service;
use App\Models\Eje;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;

class ServiciosController extends Controller
{
    public function index()
    {
        $tipo_servicio = TipoServicio::all();
        $servicio = $this->cargarDatos();
        return view('livewire.servicio.index', compact('tipo_servicio','servicio'));
    }

    private function cargarDatos()
    {
        return Service::select('servicio.id', 'servicio.servicio','tipo_servicio.tipo_servicio')
              ->join('tipo_servicio', 'tipo_servicio.id', '=', 'servicio.tipo_servicio_id')
            ->orderBy('servicio.id', 'desc')
            ->get();
    }
 
   

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'servicio' => 'required|max:30|unique:servicio,servicio,'. $request->id,
            'tipo_servicio_id' => 'required'
        ]);

        if ($validator->fails()) {
            //devuelve errores a la vista
            return response()->json(['success' => false, 'errors' => $validator->errors()->all()]);
        }

        if (!$request->id) {
            $tipo = new Service();
            $tipo->tipo_servicio_id = $request->tipo_servicio_id;
            $tipo->servicio = $request->servicio;
            if ($tipo->save()) {
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Creacion de servicio ' . $request->servicio . ' en la plataforma',
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],
                ]);

                $datos = $this->cargarDatos();
                return response()->json(['success' => true, 'message' => 'Servicio Creado Exitosamente', 'datos' => $datos]);
            }
        } else {
            $tipo = Service::findOrFail($request->id);
            $tipo->tipo_servicio_id = $request->tipo_servicio_id;
            $tipo->servicio = $request->servicio;
            if ($tipo->save()) {
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Actualizacion de servicio ' . $request->servicio . ' en la plataforma',
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],
                ]);
                $datos = $this->cargarDatos();
                return response()->json(['success' => true, 'message' => 'Servicio Actualizado Exitosamente', 'datos' => $datos]);
            }
        }
    }

    public function edit($id)
    {
        $servicio = Service::findOrFail($id);
        return response()->json(['data' => $servicio]);
    }

    public function delete($id)
    {
        $servicio = Service::findOrFail($id);

        $auditoria = Auditoria::create([
            'usuario' => auth()->user()->first_name,
            'correo' => auth()->user()->email,
            'observaciones' => 'Eliminación de Servicio ' . $servicio->servicio . ' en la plataforma',
            'direccion_ip' => $_SERVER['REMOTE_ADDR'],
        ]);
        $servicio->delete();

        return response()->json(['success' => true, 'message' => 'Servicio Eliminado']);
    }
}

    

