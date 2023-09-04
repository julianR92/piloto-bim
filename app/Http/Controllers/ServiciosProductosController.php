<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auditoria;
use App\Models\Producto;
use App\Models\Servicio;
use App\Models\ServicioProducto;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule; 
use Illuminate\Support\Facades\Config;
use Carbon\Carbon;

class ServiciosProductosController extends Controller
{

    public function index()
    {
        $servicios = Servicio::all();   
        $productos = Producto::all();
        $servicios_productos = $this->cargarDatos();
        return view('livewire.servicio-producto.index', compact('servicios','productos', 'servicios_productos'));
    }

    private function cargarDatos()
    {
        return ServicioProducto::select('servicio_producto.id','servicio_producto.cantidad','producto.nombre','servicio.servicio')->join('producto','producto.id','=', 'servicio_producto.producto_id')->join('servicio','servicio.id','=', 'servicio_producto.servicio_id')->orderBy('servicio.servicio', 'ASC')->get();
    }
 
   

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "producto_id"=>['required',Rule::unique('servicio_producto')->where(function ($query) use ($request) { return $query->where('servicio_id',$request->servicio_id);
            })->ignore($request->id, 'id')],           
            'servicio_id' => 'required',                    
            'cantidad' => 'required|numeric'

        ]);

        if ($validator->fails()) {
            //devuelve errores a la vista
            return response()->json(['success' => false, 'errors' => $validator->errors()->all()]);
        }

        if (!$request->id) {
            $servicios_productos = new ServicioProducto();
            $servicios_productos->producto_id = $request->producto_id;
            $servicios_productos->servicio_id = $request->servicio_id;
            $servicios_productos->cantidad = $request->cantidad;
            if ($servicios_productos->save()) {
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Creacion de servicio x producto N°' . $request->id . ' en la plataforma',
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],
                ]);

                $datos = $this->cargarDatos();
                return response()->json(['success' => true, 'message' => 'Prodcuto x Servicio Creado Exitosamente', 'datos' => $datos]);
            }
        } else {
            $servicios_productos = ServicioProducto::findOrFail($request->id);
            $servicios_productos->producto_id = $request->producto_id;
            $servicios_productos->servicio_id = $request->servicio_id;
            $servicios_productos->cantidad = $request->cantidad;
            if ($servicios_productos->save()) {
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Actualizacion de servicio x producto N° ' . $request->id . ' en la plataforma',
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],
                ]);
                $datos = $this->cargarDatos();
                return response()->json(['success' => true, 'message' => 'Producto x Servicio Actualizado Exitosamente', 'datos' => $datos]);
            }
        }
    }

    public function edit($id)
    {
        $producto = ServicioProducto::findOrFail($id);
        return response()->json(['data' => $producto]);
    }

    public function delete($id)
    {
        $producto = ServicioProducto::findOrFail($id);

        $auditoria = Auditoria::create([
            'usuario' => auth()->user()->first_name,
            'correo' => auth()->user()->email,
            'observaciones' => 'Eliminación de producto x servicio ' . $producto->id . ' en la plataforma',
            'direccion_ip' => $_SERVER['REMOTE_ADDR'],
        ]);
        $producto->delete();

        return response()->json(['success' => true, 'message' => 'Producto x Servicio Eliminado']);
    }
} 
    

