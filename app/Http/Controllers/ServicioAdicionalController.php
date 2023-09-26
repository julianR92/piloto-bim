<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServicioAdicional;
use App\Models\Precios;
use App\Models\Talla;
use App\Models\Auditoria;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule; 
use Illuminate\Support\Facades\Config;
use Carbon\Carbon;

class ServicioAdicionalController extends Controller
{

    public function index()
    {
       
        $servicios = $this->cargarDatos();
        return view('livewire.servicio-adicional.index', compact('servicios'));
    }

    private function cargarDatos()
    {
        return ServicioAdicional::all();
    }
 
   

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [           
             'nombre' => 'required|max:20|unique:servicios_adicionales,nombre,'. $request->id,
             "valor"=>'required|numeric',
             'comision' => 'required|numeric',

        ]);

        if ($validator->fails()) {
            //devuelve errores a la vista
            return response()->json(['success' => false, 'errors' => $validator->errors()->all()]);
        }

        if (!$request->id) {
            $servicioA = new ServicioAdicional();      
            $servicioA->nombre = $request->nombre;
            $servicioA->valor = $request->valor;
            $servicioA->comision = $request->comision;
            if ($servicioA->save()) {
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Creacion de servicio adicional ' . $request->nombre . ' en la plataforma',
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],
                ]);

                $datos = $this->cargarDatos();
                return response()->json(['success' => true, 'message' => 'Servicio Adicional Creado Exitosamente', 'datos' => $datos]);
            }
        } else {
            $servicioA = ServicioAdicional::findOrFail($request->id);
            $servicioA->nombre = $request->nombre;
            $servicioA->valor = $request->valor;
            $servicioA->comision = $request->comision;
            if ($servicioA->save()) {
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Actualizacion de servicio Adicional ' . $request->id . ' en la plataforma',
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],
                ]);
                $datos = $this->cargarDatos();
                return response()->json(['success' => true, 'message' => 'Servicio Adicional Actualizado Exitosamente', 'datos' => $datos]);
            }
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
    

