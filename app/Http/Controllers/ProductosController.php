<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auditoria;
use App\Models\Producto;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule; 
use Illuminate\Support\Facades\Config;
use Carbon\Carbon;

class ProductosController extends Controller
{

    public function index()
    {
        $tipos = Config::get('global.tipos_producto');       
        $productos = $this->cargarDatos();
        return view('livewire.productos.index', compact('tipos','productos'));
    }

    private function cargarDatos()
    {
        return Producto::all();
    }
 
   

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|unique:producto,nombre,'. $request->id,
            'tipo' => 'required',
            'presentacion' => 'required',            
             'valor_unitario' => 'required|numeric'

        ]);

        if ($validator->fails()) {
            //devuelve errores a la vista
            return response()->json(['success' => false, 'errors' => $validator->errors()->all()]);
        }

        if (!$request->id) {
            $productos = new Producto();
            $productos->nombre = $request->nombre;
            $productos->tipo = $request->tipo;
            $productos->presentacion = $request->presentacion;
            $productos->valor_unitario = $request->valor_unitario;
            if ($productos->save()) {
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Creacion de producto ' . $request->nombre . ' en la plataforma',
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],
                ]);

                $datos = $this->cargarDatos();
                return response()->json(['success' => true, 'message' => 'Producto Creado Exitosamente', 'datos' => $datos]);
            }
        } else {
            $productos = Producto::findOrFail($request->id);
            $productos->nombre = $request->nombre;
            $productos->tipo = $request->tipo;
            $productos->presentacion = $request->presentacion;
            $productos->valor_unitario = $request->valor_unitario;
            if ($productos->save()) {
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Actualizacion de valor ' . $request->nombre . ' en la plataforma',
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],
                ]);
                $datos = $this->cargarDatos();
                return response()->json(['success' => true, 'message' => 'Producto Actualizado Exitosamente', 'datos' => $datos]);
            }
        }
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        return response()->json(['data' => $producto]);
    }

    public function delete($id)
    {
        $producto = Producto::findOrFail($id);

        $auditoria = Auditoria::create([
            'usuario' => auth()->user()->first_name,
            'correo' => auth()->user()->email,
            'observaciones' => 'Eliminación de producto ' . $producto->nombre . ' en la plataforma',
            'direccion_ip' => $_SERVER['REMOTE_ADDR'],
        ]);
        $producto->delete();

        return response()->json(['success' => true, 'message' => 'Producto Eliminado']);
    }
} 
    

