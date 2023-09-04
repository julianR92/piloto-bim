<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Talla;
use App\Models\Auditoria;
use Illuminate\Support\Facades\Validator;

class TallaController extends Controller
{
    public function index()
    {
       
        $tallas = $this->cargarDatos();
        return view('livewire.tallas.index', compact('tallas'));
    }

    private function cargarDatos()
    {
        return Talla::all();
    }
 
   

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'talla' => 'required|max:10|unique:tallas,talla,'. $request->id,           
        ]);

        if ($validator->fails()) {
            //devuelve errores a la vista
            return response()->json(['success' => false, 'errors' => $validator->errors()->all()]);
        }

        if (!$request->id) {
            $talla = new Talla();
            $talla->talla = $request->talla;       
            if ($talla->save()) {
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Creacion de talla ' . $request->talla . ' en la plataforma',
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],
                ]);

                $datos = $this->cargarDatos();
                return response()->json(['success' => true, 'message' => 'Talla Creada Exitosamente', 'datos' => $datos]);
            }
        } else {
            $talla = Talla::findOrFail($request->id);
            $talla->talla = $request->talla;             
            if ($talla->save()) {
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Actualizacion de talla ' . $talla->servicio . ' en la plataforma',
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],
                ]);
                $datos = $this->cargarDatos();
                return response()->json(['success' => true, 'message' => 'Talla Actualizada Exitosamente', 'datos' => $datos]);
            }
        }
    }

    public function edit($id)
    {
        $talla = Talla::findOrFail($id);
        return response()->json(['data' => $talla]);
    }

    public function delete($id)
    {
        $talla = Talla::findOrFail($id);

        $auditoria = Auditoria::create([
            'usuario' => auth()->user()->first_name,
            'correo' => auth()->user()->email,
            'observaciones' => 'Eliminación de talla ' . $talla->servicio . ' en la plataforma',
            'direccion_ip' => $_SERVER['REMOTE_ADDR'],
        ]);
        $talla->delete();

        return response()->json(['success' => true, 'message' => 'Talla Eliminada']);
    }  
  
}
