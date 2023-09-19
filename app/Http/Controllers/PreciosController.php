<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;
use App\Models\Precios;
use App\Models\Talla;
use App\Models\Auditoria;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule; 
use Illuminate\Support\Facades\Config;
use Carbon\Carbon;

class PreciosController extends Controller
{

    public function index()
    {
        $talla = Talla::all();
        $servicio = Servicio::all();
        $precios = $this->cargarDatos();
        return view('livewire.precios.index', compact('talla','servicio','precios'));
    }

    private function cargarDatos()
    {
        return Precios::select('precios.id', 'precios.valor','tallas.talla','servicio.servicio', 'precios.comision')
              ->join('tallas', 'tallas.id', '=', 'precios.talla_id')
              ->join('servicio', 'servicio.id', '=', 'precios.servicio_id')
              ->orderBy('precios.id', 'desc')
              ->get();
    }
 
   

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'servicio_id' => 'required',
            'talla_id' => ['required',Rule::unique('precios')->where(function ($query) use ($request) { return $query->where('servicio_id',$request->servicio_id)->where('talla_id', $request->talla_id);})->ignore($request->id, 'id')],
             "valor"=>'required|numeric',
             'comision' => 'required|numeric',

        ]);

        if ($validator->fails()) {
            //devuelve errores a la vista
            return response()->json(['success' => false, 'errors' => $validator->errors()->all()]);
        }

        if (!$request->id) {
            $precio = new Precios();
            $precio->servicio_id = $request->servicio_id;
            $precio->talla_id = $request->talla_id;
            $precio->valor = $request->valor;
            $precio->comision = $request->comision;
            if ($precio->save()) {
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Creacion de precio ' . $request->valor . ' en la plataforma',
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],
                ]);

                $datos = $this->cargarDatos();
                return response()->json(['success' => true, 'message' => 'Precio Creado Exitosamente', 'datos' => $datos]);
            }
        } else {
            $precio = Precios::findOrFail($request->id);
            $precio->servicio_id = $request->servicio_id;
            $precio->talla_id = $request->talla_id;
            $precio->valor = $request->valor;
            $precio->comision = $request->comision;
            if ($precio->save()) {
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Actualizacion de valor ' . $request->valor . ' en la plataforma',
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],
                ]);
                $datos = $this->cargarDatos();
                return response()->json(['success' => true, 'message' => 'Precio Actualizado Exitosamente', 'datos' => $datos]);
            }
        }
    }

    public function edit($id)
    {
        $servicio = Precios::findOrFail($id);
        return response()->json(['data' => $servicio]);
    }

    public function delete($id)
    {
        $precio = Precios::findOrFail($id);

        $auditoria = Auditoria::create([
            'usuario' => auth()->user()->first_name,
            'correo' => auth()->user()->email,
            'observaciones' => 'Eliminación de precio ' . $precio->valor . ' en la plataforma',
            'direccion_ip' => $_SERVER['REMOTE_ADDR'],
        ]);
        $precio->delete();

        return response()->json(['success' => true, 'message' => 'Precio Eliminado']);
    }
} 
    

