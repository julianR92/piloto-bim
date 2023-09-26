<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;
use App\Models\Agenda;
use App\Models\Pago;
use App\Models\MedioPago;
use App\Models\ServicioProducto;
use App\Models\Profesional;
use App\Models\Cliente;
use App\Models\Cuentas;
use App\Models\ServicioAdicional;
use App\Models\Descuento;
use App\Models\Auditoria;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdicionalController extends Controller
{

    public function index()
    {
        $clientes = Cliente::all();
        $profesionales = Profesional::where('id', '<>', 1)->orderBy('nombres', 'ASC')->get();
        $cuentas = Cuentas::where('estado',1)->get();
        $servicios_adicionales = ServicioAdicional::all();
        $medios_pago = MedioPago::all();       
        return view('livewire.pagos.adicional', compact('servicios_adicionales', 'clientes', 'profesionales', 'medios_pago', 'cuentas'));
    }  
   
      
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'cliente_id' => 'required',
            'servicio_adicional_id' => 'required',
            'profesional_id' => 'required',          
            'comision' => 'required|numeric',
            'medio_pago_id' => 'required',
            'cuenta_pago_id' => 'required',          
            'valor_pagar' => 'required|numeric',
            'medio_pago' => 'required|max:20',



        ]);

        if ($validator->fails()) {
            //devuelve errores a la vista
            return response()->json(['success' => false, 'errors' => $validator->errors()->all()]);
        }

       

        DB::beginTransaction();

        try {
             $verificado = 0;
            if($request->medio_pago_id == 1){
                $verificado = 1;    
            }

            $pago_adicional_id =  DB::table('pago_adicionales')->insertGetId([
                'cliente_id' => $request->cliente_id,
                'servicio_adicional_id' => $request->servicio_adicional_id,             
                'valor_pagar' => $request->valor_pagar,
                'comision' => $request->comision,
                'medio_pago' => $request->medio_pago,            
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')

            ]);
            if($request->medio_pago_id != 00){
            $trasferencias = DB::table('transferencias_pago')->insert([
                'cliente_id'=>$request->cliente_id,
                'valor' => $request->valor_pagar,
                'medio_pago_id'=>$request->medio_pago_id,
                'cuenta_pago_id'=>$request->cuenta_pago_id,
                'referencia_pago'=>$request->referencia_pago,
                'fecha'=>date('Y-m-d'),
                'id_pago'=>$pago_adicional_id,
                'tipo'=>'S',
                'verificado'=>$verificado,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')

            ]);
         }


            $adicional_profesional = DB::table('adicional_profesional')->insert([
                'profesional_id' => $request->profesional_id,
                'adicional_id' => $pago_adicional_id,
                'comision' => $request->comision,
                'fecha'=>date('Y-m-d'),
                'porcentaje' =>'100%',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')

            ]);          

            $auditoria = DB::table('auditoria')->insert(
                [
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Creacion de pago de servicios adicionales # ' . $request->pago_adicional_id . ' en la plataforma',
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],

                ]
            );

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Pago Realizado Exitosamente!', 'valor' => $request->valor_pagar]);

            // all good
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            return response()->json(['success' => false, 'errors' => ["Se ha producido un error $errorCode en la base de datos"], 'errorMessage' => $errorMessage]);
        }catch (\Exception $e) {

            $response = [ 'success' => false,
                'errors' =>[$e->getMessage()]
            ];
            return response()->json($response);

        }
    }

    public function indexCloseProcedure()
    {

        $procedimientos = $this->loadProcedure();
        $profesionales = Profesional::where('id', '<>', 1)->orderBy('nombres', 'ASC')->get();
        $profesionalesAll = Profesional::all();
        return view('livewire.pagos.cierre', compact('procedimientos', 'profesionales', 'profesionalesAll'));
    }

    public function loadProcedure()
    {

        return Pago::select('pago_procedimiento.id', 'pago_procedimiento.servicio_id', 'pago_procedimiento.precio', 'pago_procedimiento.valor_pagar', 'pago_procedimiento.medio_pago', 'pago_procedimiento.comision', 'pago_procedimiento.created_at', 'clientes.nombres', 'clientes.apellidos', 'clientes.documento', 'tallas.talla', 'servicio.servicio', 'planes_dcto.plan', 'planes_dcto.descuento')->leftjoin('clientes', 'clientes.id', '=', 'pago_procedimiento.cliente_id')->leftjoin('servicio', 'servicio.id', '=', 'pago_procedimiento.servicio_id')->leftjoin('tallas', 'tallas.id', '=', 'pago_procedimiento.talla_id')->leftjoin('planes_dcto', 'planes_dcto.id', '=', 'pago_procedimiento.planes_id')->where('pago_procedimiento.estado', 'ABIERTO')->orderBy('pago_procedimiento.id', 'DESC')->get();
    }
    public function searchProcedure($id, $servicio_id)
    {

        $procedimiento = Pago::select('pago_procedimiento.id', 'pago_procedimiento.servicio_id', 'pago_procedimiento.precio', 'pago_procedimiento.valor_pagar', 'pago_procedimiento.medio_pago', 'pago_procedimiento.comision', 'pago_procedimiento.created_at', 'clientes.nombres', 'clientes.apellidos', 'clientes.documento', 'tallas.talla', 'servicio.servicio', 'planes_dcto.plan', 'planes_dcto.descuento')->leftjoin('clientes', 'clientes.id', '=', 'pago_procedimiento.cliente_id')->leftjoin('servicio', 'servicio.id', '=', 'pago_procedimiento.servicio_id')->leftjoin('tallas', 'tallas.id', '=', 'pago_procedimiento.talla_id')->leftjoin('planes_dcto', 'planes_dcto.id', '=', 'pago_procedimiento.planes_id')->where('pago_procedimiento.id', $id)->orderBy('pago_procedimiento.id', 'DESC')->get()->first();
        $productos = ServicioProducto::select('servicio_producto.id', 'servicio_producto.producto_id', 'servicio_producto.cantidad', 'producto.nombre')->join('producto', 'producto.id', '=', 'servicio_producto.producto_id')->where('servicio_producto.servicio_id', $servicio_id)->get();
        if ($productos->count() > 0) {
            return response()->json(['success' => true, 'data' => $procedimiento, 'productos' => $productos]);
        } else {
            return response()->json(['false' => true, 'message' => 'Servicio sin productos asignados']);
        }
    }

    public function storeCierre(Request $request)
    {
        $data= $request->all();

        // Definir reglas de validación
        $reglas = [
            'datos.profesional_uno' => 'required',
            'datos.profesional_producto' => 'required',  // profesional_producto debe estar presente y no ser nulo
            'datos.id' => 'required',  // datos required
         

            'productos' => 'required|array',  // productos debe ser un array y no estar vacío
            'productos.*.cantidad' => 'required|integer',  // Cada elemento en productos debe tener una cantidad válida
            'productos.*.producto_id' => 'required|integer',  // Cada elemento en productos debe tener un producto_id válido
            'productos.*.profesional_id' => 'required|integer',  // Cada elemento en productos debe tener un producto_id válido
            'productos.*.pago_id' => 'required|integer',  // Cada elemento en productos debe tener un producto_id válido

            'estilistas' => 'required|array',  // estilistas debe ser un array y no estar vacío
            'estilistas.*.profesional_id' => 'required|integer',  // Cada elemento en estilistas debe tener un profesional_id válido
            'estilistas.*.comision' => 'required|numeric',
            'estilistas.*.procedimiento_id' => 'required|numeric',
            'estilistas.*.porcentaje' => 'required',
            
            'datos.profesional_dos' => function ($attribute, $value, $fail) use ($data) {
           $servicioCompartido = array_key_exists('servicio_compartido', $data['datos']) ? $data['datos']['servicio_compartido'] : false;

             if ($servicioCompartido && is_null($value)) {
               $fail('El campo ' . $attribute . ' es requerido cuando servicio_compartido existe.');
                }},// Cada elemento en estilistas debe tener una comisión válida
        ];
      
        $validator = Validator::make($request->all(), $reglas);

        if ($validator->fails()) {            
            return response()->json(['success' => false, 'errors' => $validator->errors()->all()]);
        }

        DB::beginTransaction();

        try {          

            $pago_procedimiento= DB::table('pago_procedimiento')->where('id', $request['datos']['id'])->update([
                'estado' => 'CERRADO',
                'observaciones'=> 'Procedimiento cerrado en la plataforma',
                'updated_at'=>date('Y-m-d H:i:s')              

            ]);
             
            foreach($request['productos'] as $producto){

                $producto_id = DB::table('producto_semana')->insertGetId(
                    [
                        'producto_id' => $producto['producto_id'],
                        'profesional_id' => $producto['profesional_id'],
                        'tipo_transaccion' => 'SALIDA',
                        'valor' => $producto['cantidad'],
                        'fecha'=> date('Y-m-d'),
                        'procedimiento_id' => $producto['pago_id'],
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                        
                            
                    ]
                );

                $auditoria = DB::table('auditoria')->insert(
                    [
                        'usuario' => auth()->user()->first_name,
                        'correo' => auth()->user()->email,
                        'observaciones' => 'Creacion de salida' . $producto_id . ' en  el producto semana',
                        'direccion_ip' => $_SERVER['REMOTE_ADDR'],
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
    
                    ]
                );
    

            }
            foreach($request['estilistas'] as $profesional){

                $procedimiento_profesional_id = DB::table('procedimiento_profesional')->insertGetId(
                    [
                        'profesional_id' => $profesional['profesional_id'],
                        'procedimiento_id' => $profesional['procedimiento_id'],
                        'comision' => $profesional['comision'],                        
                        'fecha'=> date('Y-m-d'),
                        'porcentaje' => $profesional['porcentaje'],
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                            
                    ]
                );

                $auditoria = DB::table('auditoria')->insert(
                    [
                        'usuario' => auth()->user()->first_name,
                        'correo' => auth()->user()->email,
                        'observaciones' => 'Creacion de procedimiento profesional #' . $procedimiento_profesional_id . ' en el procedimiento_profesional',
                        'direccion_ip' => $_SERVER['REMOTE_ADDR'],
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
    
                    ]
                );
    

            }
            


            $auditoria = DB::table('auditoria')->insert(
                [
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Actualizacio de pago de procedimiento # ' . $request['datos']['id'] . ' en la plataforma a estado CERRADO',
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')

                ]
            );

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Procedimiento Cerrado Exitosamente!']);

            // all good
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            return response()->json(['success' => false, 'errors' => ["Se ha producido un error $errorCode en la base de datos"], 'errorMessage' => $errorMessage]);
        }
       
    }
}
