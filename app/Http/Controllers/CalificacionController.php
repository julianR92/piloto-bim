<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calificacion;
use App\Models\Auditoria;
use Illuminate\Support\Facades\Validator;

class CalificacionController extends Controller
{
    public function index()
    {
       
        $calificaciones = $this->cargarDatos();
        return view('livewire.calificacion.index', compact('calificaciones'));
    }

    private function cargarDatos()
    {
        return Calificacion::all();
    }
 
   

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'calificacion' => 'required|max:20|unique:calificacion,calificacion,'. $request->id,           
        ]);

        if ($validator->fails()) {
            //devuelve errores a la vista
            return response()->json(['success' => false, 'errors' => $validator->errors()->all()]);
        }

        if (!$request->id) {
            $calificacion = new Calificacion();
            $calificacion->calificacion = $request->calificacion;       
            if ($calificacion->save()) {
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Creacion de calificacion ' . $request->calificacion . ' en la plataforma',
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],
                ]);

                $datos = $this->cargarDatos();
                return response()->json(['success' => true, 'message' => 'Calificacion Creada Exitosamente', 'datos' => $datos]);
            }
        } else {
            $calificacion = Calificacion::findOrFail($request->id);
            $calificacion->calificacion = $request->calificacion;                
            if ($calificacion->save()) {
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Actualizacion de calificacion ' . $request->calificacion . ' en la plataforma',
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],
                ]);
                $datos = $this->cargarDatos();
                return response()->json(['success' => true, 'message' => 'Calificacion Actualizada Exitosamente', 'datos' => $datos]);
            }
        }
    }

    public function edit($id)
    {
        $calificacion = Calificacion::findOrFail($id);
        return response()->json(['data' => $calificacion]);
    }

    public function delete($id)
    {
        $calificacion = Calificacion::findOrFail($id);

        $auditoria = Auditoria::create([
            'usuario' => auth()->user()->first_name,
            'correo' => auth()->user()->email,
            'observaciones' => 'Eliminación de calificacion ' . $calificacion->calificacion . ' en la plataforma',
            'direccion_ip' => $_SERVER['REMOTE_ADDR'],
        ]);
        $calificacion->delete();

        return response()->json(['success' => true, 'message' => 'Calificacion Eliminada']);
    }  
}
