<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Abono;
use App\Models\Cuentas;
use App\Models\MedioPago;
use Illuminate\Support\Facades\DB;
use App\Models\Auditoria;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;

class AbonosController extends Controller
{

    
    public function index(){    
        
        $clientes = $this->cargarDatos();
           
        return view('livewire.abonos.index',compact('clientes'));
        
       }

    public function cargarDatos() { 
        return Cliente::where('estado', 1)->orderBy('id', 'DESC')->get();
    }

    public function clienteAbonos($id){

      $cliente = Cliente::findOrFail($id);
      $abonos_clientes = $this->cargarAbonos($id);  
      $estado_abonos = Config::get('global.estados_abono');
      $medio_pago = MedioPago::all();
      $cuentas = Cuentas::where('estado', 1)->get();      
      return view('livewire.abonos.abonos_cliente',compact('cliente','abonos_clientes','estado_abonos', 'medio_pago', 'cuentas'));
    }

    public function cargarAbonos($id){
        return Abono::select('abonos.id', 'abonos.valor', 'abonos.cliente_id', 'abonos.estado', 'abonos.verificado', 'abonos.referencia_pago', 'abonos.fecha_pago', 'medio_pago.medio_pago','abonos.created_at')
        ->join('medio_pago', 'medio_pago.id', '=', 'abonos.medio_pago_id')->where('cliente_id', $id)->orderBy('abonos.created_at', 'DESC')->get();
    }
     
     

    public function store(Request $request){ 
        
        $validator = Validator::make($request->all(), [            
            'valor' => 'required|numeric',
            'estado' => 'required',
            'medio_pago_id' => 'required',
            'cuenta_pago_id' => 'required',
            'referencia_pago' => 'required|max:20|unique:abonos,referencia_pago,'. $request->id,
            'cliente_id' => 'required',
        ],[
          'referencia_pago.unique' => "Este numero de Ref: ".$request->referencia_pago." ya se encuentra registrado"  
        ]);
    
        if($validator->fails()){
            //devuelve errores a la vista
         return response()->json([ 'success'=>false,'errors'=>$validator->errors()->all()]);
        }
        if($request->referencia_pago== 'SIN REFERENCIA'){
            $ref = null;
           }else{
            $ref = $request->referencia_pago;
           }
           
        if (!$request->id) {

            if($request->medio_pago_id== 2){ 
                $verficado = 0;}
                else{
                 $verficado = 1;
            }            
             
            $abono = new Abono();
            $abono->cliente_id   = $request->cliente_id;
            $abono->valor  = $request->valor;          
            $abono->medio_pago_id   = $request->medio_pago_id;
            $abono->cuenta_pago_id    = $request->cuenta_pago_id;
            $abono->estado  = $request->estado;
            $abono->referencia_pago = $ref; 
            $abono->fecha_pago =  $request->fecha_pago; 
            $abono->observaciones =  $request->observaciones; 
           
                    
             if($abono->save()){
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones'=> 'Creacion de abono '. $request->valor .' a cliente '.$request->cliente_id. ' en la plataforma',
                    'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           
        
                ]);
                
                $datos = $this->cargarAbonos($request->cliente_id);
                return response()->json(['success'=>true,'message'=>'Abono Creado','datos'=>$datos]);   
    
             }
        }else{
            if($request->medio_pago_id== 2){ 
                $verficado = 0;}
                else{
                 $verficado = 1;
            }    

            $abono = Abono::findOrFail($request->id);
            $abono->cliente_id   = $request->cliente_id ;
            $abono->valor  = $request->valor;          
            $abono->medio_pago_id   = $request->medio_pago_id;
            $abono->cuenta_pago_id    = $request->cuenta_pago_id;
            $abono->estado  = $request->estado;  
            $abono->verificado =  $verficado;  
            $abono->referencia_pago = $ref; 
            $abono->fecha_pago =  $request->fecha_pago; 
            $abono->observaciones =  $request->observaciones;                       
            if($abono->save()){
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones'=> 'Actualizacion de abono '. $request->id .'por valor '.$request->valor.' en la plataforma ',
                    'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           
        
                ]);
                   $datos = $this->cargarAbonos($request->cliente_id); 
                   return response()->json(['success'=>true,'message'=>'Abono Actualizado','datos'=>$datos]);   
    
             }
    
        }
    
    
      }

      public function edit($id){
        $abono = Abono::findOrFail($id);
        return response()->json(['data' => $abono]);
      }
      

      public function delete($id){
        $abono = Abono::findOrFail($id);
        
     $auditoria = Auditoria::create([
         'usuario' => auth()->user()->first_name,
         'correo' => auth()->user()->email,
         'observaciones'=> 'Eliminación de abono '. $abono->id .' de valor '.$abono->valor.' en la plataforma',
         'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           
 
     ]);
     $abono->delete();         
         return response()->json(['success'=>true,'message'=>'Abono Eliminada']); 
   }
}
