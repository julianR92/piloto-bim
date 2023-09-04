<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedioPago;
use App\Models\Auditoria;
use Illuminate\Support\Facades\Validator;
class MediosPagoController extends Controller
{
    public function index()
    {
        $medios_pago = $this->cargarDatos();
        return view('livewire.medio-pago.index', compact('medios_pago'));
    }

    private function cargarDatos()
    {
        return MedioPago::select('id', 'medio_pago')
            ->orderBy('id', 'desc')
            ->get();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'medio_pago' => 'required|max:30|unique:medio_pago,medio_pago,'. $request->id,
        ]);

        if ($validator->fails()) {
            //devuelve errores a la vista
            return response()->json(['success' => false, 'errors' => $validator->errors()->all()]);
        }

        if (!$request->id) {
            $tipo = new MedioPago();
            $tipo->medio_pago = $request->medio_pago;
            if ($tipo->save()) {
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Creacion de medio de pago ' . $request->medio_pago . ' en la plataforma',
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],
                ]);

                $datos = $this->cargarDatos();
                return response()->json(['success' => true, 'message' => 'Tipo Medio de pago Creado', 'datos' => $datos]);
            }
        } else {
            $tipo = MedioPago::findOrFail($request->id);
            $tipo->medio_pago = $request->medio_pago;
            if ($tipo->save()) {
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Actualizacion de medio de pago ' . $request->medio_pago . ' en la plataforma',
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],
                ]);
                $datos = $this->cargarDatos();
                return response()->json(['success' => true, 'message' => 'Medio de Pago Actualizado', 'datos' => $datos]);
            }
        }
    }

    public function edit($id)
    {
        $medios_pago = MedioPago::findOrFail($id);
        return response()->json(['data' => $medios_pago]);
    }

    public function delete($id)
    {
        $medios_pago = MedioPago::findOrFail($id);

        $auditoria = Auditoria::create([
            'usuario' => auth()->user()->first_name,
            'correo' => auth()->user()->email,
            'observaciones' => 'Eliminación de medio de Pago ' . $medios_pago->medio_pago . ' en la plataforma',
            'direccion_ip' => $_SERVER['REMOTE_ADDR'],
        ]);
        $medios_pago->delete();

        return response()->json(['success' => true, 'message' => 'Medio de Pago Eliminado']);
    }
}



