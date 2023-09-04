<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Descuento;
use Illuminate\Support\Facades\DB;
use App\Models\Auditoria;
use Illuminate\Support\Facades\Validator;

class DescuentosController extends Controller
{
    public function index()
    {
        $descuentos = $this->cargarDatos();
        return view('livewire.descuentos.index', compact('descuentos'));
    }

    private function cargarDatos()
    {
        return Descuento::all();
    }
   

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'plan' => 'required|max:30|unique:planes_dcto,plan,'. $request->id,
            'descuento' => 'required|numeric|max:100|min:0',
            'estado' => 'required'
        ]);

        if ($validator->fails()) {
            //devuelve errores a la vista
            return response()->json(['success' => false, 'errors' => $validator->errors()->all()]);
        }

        if (!$request->id) {
            $descuento = new Descuento();
            $descuento->plan = $request->plan;
            $descuento->descuento = $request->descuento;
            $descuento->estado = $request->estado;
            if ($descuento->save()) {
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Creacion de descuento ' . $request->plan . ' en la plataforma',
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],
                ]);

                $datos = $this->cargarDatos();
                return response()->json(['success' => true, 'message' => 'Descuento Creado Exitosamente', 'datos' => $datos]);
            }
        } else {
            $descuento = Descuento::findOrFail($request->id);
            $descuento->plan = $request->plan;
            $descuento->descuento = $request->descuento;
            $descuento->estado = $request->estado;
            if ($descuento->save()) {
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Actualizacion de servicio ' . $request->servicio . ' en la plataforma',
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],
                ]);
                $datos = $this->cargarDatos();
                return response()->json(['success' => true, 'message' => 'Descuento Actualizado Exitosamente', 'datos' => $datos]);
            }
        }
    }

    public function edit($id)
    {
        $descuento = Descuento::findOrFail($id);
        return response()->json(['data' => $descuento]);
    }

    public function delete($id)
    {
        $descuento = Descuento::findOrFail($id);

        $auditoria = Auditoria::create([
            'usuario' => auth()->user()->first_name,
            'correo' => auth()->user()->email,
            'observaciones' => 'Eliminación de descuento ' . $descuento->plan . ' en la plataforma',
            'direccion_ip' => $_SERVER['REMOTE_ADDR'],
        ]);
        $descuento->delete();

        return response()->json(['success' => true, 'message' => 'Descuento Eliminado']);
    }
}
