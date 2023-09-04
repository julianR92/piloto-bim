<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auditoria;
use App\Models\Profesional;
use App\Models\ProductoSemana;
use App\Models\Producto;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule; 
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SemanarioController extends Controller
{

    public function index()
    {
        $tipos = Config::get('global.tipos_inventario');       
        $profesionales = Profesional::all();
        $productos = Producto::all();
        return view('livewire.producto-semana.index', compact('tipos','profesionales', 'productos'));
    }
 
    public function indexBuscar()
    {
        $tipos = Config::get('global.tipos_inventario');       
        $profesionales = Profesional::all();
        $productos = Producto::all();
        return view('livewire.producto-semana.buscar', compact('tipos','profesionales', 'productos'));
    }
 
   

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
             'profesional_mo' => 'required',
             'producto_mo' => 'required',
             'tipo_transaccion' => 'required',            
             'fecha' => 'required|date',
             'valor' => 'required|numeric'

        ]);

        if ($validator->fails()) {
            //devuelve errores a la vista
            return response()->json(['success' => false, 'errors' => $validator->errors()->all()]);
        }

        if (!$request->id) {
            $productos = new ProductoSemana();
            $productos->producto_id  = $request->producto_mo;
            $productos->profesional_id  = $request->profesional_mo;
            $productos->tipo_transaccion = $request->tipo_transaccion;
            $productos->valor = $request->valor;
            $productos->fecha = $request->fecha;
            if ($productos->save()) {
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Ingreso de  producto con ID: '.$request->producto_mo. ' con valor de ' . $request->valor . ' tipo de inventario '.$request->tipo_transaccion.' en el en la plataforma al profesional con ID '.$request->profesional_mo,
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],
                ]);
              
                return response()->json(['success' => true, 'message' => 'Inventario Creado Exitosamente']);
            }
        } else {
            $productos = ProductoSemana::findOrFail($request->id);
            $productos->producto_id  = $request->producto_mo;
            $productos->profesional_id  = $request->profesional_mo;
            $productos->tipo_transaccion = $request->tipo_transaccion;
            $productos->valor = $request->valor;
            $productos->fecha = $request->fecha;
            if ($productos->save()) {
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Actualizacion de  producto con ID: '.$request->producto_mo. ' con valor de ' . $request->valor . ' tipo de inventario '.$request->tipo_transaccion.' en el en la plataforma al profesional con ID '.$request->profesional_mo,
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],
            ]);
                
                return response()->json(['success' => true, 'message' => 'Inventario Actualizado Exitosamente']);
            }
        }
    }

    public function edit($id)
    {
        $producto = ProductoSemana::findOrFail($id);
        return response()->json(['data' => $producto]);
    }

    public function delete($id)
    {
        $producto = ProductoSemana::findOrFail($id);

        $auditoria = Auditoria::create([
            'usuario' => auth()->user()->first_name,
            'correo' => auth()->user()->email,
            'observaciones' => 'Eliminación de inventario ' . $id . ' en la plataforma',
            'direccion_ip' => $_SERVER['REMOTE_ADDR'],
        ]);
        $producto->delete();

        return response()->json(['success' => true, 'message' => 'Inventario Eliminado']);
    }

    public function queryWeek(Request $request){
        
        
        $query = ProductoSemana::select('producto_semana.id', 'producto_semana.tipo_transaccion', 'producto_semana.fecha', 'producto_semana.valor','producto_semana.producto_id','producto_semana.profesional_id', 'profesionales.nombres', 'profesionales.apellidos', 'producto.nombre as nombre_producto')->join('profesionales', 'profesionales.id', '=', 'producto_semana.profesional_id')->join('producto', 'producto.id', '=', 'producto_semana.producto_id')->where('producto_semana.producto_id', $request->producto)->where('producto_semana.profesional_id', $request->profesional)
        ->whereBetween('producto_semana.fecha', [$request->fecha_inicial, $request->fecha_fin])->orderByRaw("FIELD(tipo_transaccion, 'STOCK', 'ENTRADA', 'SALIDA', 'CIERRE', 'FALTANTE', 'SOBRANTE')")->get();
        return response()->json(['data' => $query]);
    }

    public function queryAdmin(Request $request){
        
        
        $query = ProductoSemana::select('producto_semana.id', 'producto_semana.tipo_transaccion', 'producto_semana.fecha', 'producto_semana.valor','producto_semana.producto_id','producto_semana.profesional_id', 'profesionales.nombres', 'profesionales.apellidos', 'producto.nombre as nombre_producto')->join('profesionales', 'profesionales.id', '=', 'producto_semana.profesional_id')->join('producto', 'producto.id', '=', 'producto_semana.producto_id')->where('producto_semana.producto_id', 'LIKE', $request->producto)->where('producto_semana.profesional_id', 'LIKE', $request->profesional)->where('producto_semana.tipo_transaccion', 'LIKE', $request->tipo_transaccion)->whereBetween('producto_semana.fecha', [$request->fecha_inicial, $request->fecha_fin])->orderBy('producto_semana.id', 'DESC')->get();      

        
        return response()->json(['data' => $query]);
    }

    public function closeWeek(Request $request){
        $request = $request->all();      
        
        foreach ($request as $inventario) {  
            
            $productos = new ProductoSemana();
            $productos->producto_id= $inventario['producto_id'];
            $productos->profesional_id=$inventario['profesional_id'];
            $productos->tipo_transaccion = $inventario['tipo_transaccion'];
            $productos->valor = $inventario['valor'];
            $productos->fecha = date('Y-m-d');
            $productos->save();

            $auditoria = Auditoria::create([
                'usuario' => auth()->user()->first_name,
                'correo' => auth()->user()->email,
                'observaciones' => 'Actualizacion de  producto con ID: '.$inventario['producto_id']. ' con valor de ' .  $inventario['valor'] . ' tipo de inventario '.$inventario['tipo_transaccion'].' en el en la plataforma al profesional con ID '.$inventario['profesional_id'],
                'direccion_ip' => $_SERVER['REMOTE_ADDR']
            ]);            
            
       }
       return response()->json(['success' => true, 'message' => 'Inventario Cerrado Exitosamente']);

       

       


  }
        
} 
    

