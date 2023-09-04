<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Abono;
use App\Models\Cuentas;
use App\Models\MedioPago;
use App\Models\Calificacion;
use Illuminate\Support\Facades\DB;
use App\Models\Auditoria;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use Barryvdh\DomPDF\Facade\Pdf;

class ClientesController extends Controller
{
    public function index()
    {   
        $medio_pago = MedioPago::all();
        $calificaciones = Calificacion::all();
        $clientes = $this->cargarDatos();           
        return view('livewire.clientes.index', compact('clientes', 'medio_pago', 'calificaciones'));
    }

    public function cargarDatos()
    {        
    return  Cliente::select('id', 'nombres','apellidos','telefono','whatsapp','instagram', 'estado','observacion', 'fecha_nacimiento', 'calificacion_id')->orderBy('id', 'desc')
      ->get();
    }

      

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'documento' => 'required|max:15|unique:clientes,documento,'. $request->id,
            'nombres' => 'required|max:15|string',
            'apellidos' => 'required|max:15|string',
            'telefono' => 'required|digits:10|numeric',
            'whatsapp' => 'digits:10|numeric|nullable',
            'instagram' => 'string|nullable',
            'observacion' => 'max:100|nullable',
            'fecha_nacimiento' => 'date|nullable',
        ]);

        if ($validator->fails()) {
            //devuelve errores a la vista
            return response()->json(['success' => false, 'errors' => $validator->errors()->all()]);
        }

        if (!$request->id) {
            $cliente = new Cliente();
            $cliente->documento = $request->documento;
            $cliente->nombres = $request->nombres;
            $cliente->apellidos = $request->apellidos;
            $cliente->telefono = $request->telefono;
            $cliente->fecha_nacimiento = $request->fecha_nacimiento;
            $cliente->whatsapp = $request->whatsapp;
            $cliente->calificacion_id  = $request->calificacion_id;
            $cliente->instagram = $request->instagram;
            $cliente->observacion = $request->observacion;
            $cliente->estado = 1;
            if ($cliente->save()) {
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Creacion de cliente ' . $request->documento . ' en la plataforma',
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],
                ]);

                $datos = $this->cargarDatos();
                return response()->json(['success' => true, 'message' => 'Cliente creado Exitosamente', 'datos' => $datos]);
            }
        } else {
            $cliente = Cliente::findOrFail($request->id);
            $cliente->documento = $request->documento;
            $cliente->nombres = $request->nombres;
            $cliente->apellidos = $request->apellidos;
            $cliente->telefono = $request->telefono;
            $cliente->fecha_nacimiento = $request->fecha_nacimiento;
            $cliente->whatsapp = $request->whatsapp;
            $cliente->calificacion_id  = $request->calificacion_id;
            $cliente->instagram = $request->instagram;
            $cliente->observacion = $request->observacion;
            if ($cliente->save()) {
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Actualizacion de cliente ' . $request->documento . ' en la plataforma',
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],
                ]);
                $datos = $this->cargarDatos();
                return response()->json(['success' => true, 'message' => 'Cliente actualizado exitosamente', 'datos' => $datos]);
            }
        }
    }
    public function storeAbonos(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'nombre_abono' => 'required',
            // 'abonos.*.referencia_pago' => 'unique:abonos,referencia_pago',
            
        ]);
        if ($validator->fails()) {
            //devuelve errores a la vista
            return response()->json(['success' => false, 'errors' => $validator->errors()->all()]);
        }       
              

        if ($request->id) {
            
            foreach($request->abonos as $abono){
                if($abono['medio_pago_id']== 2){ 
                   $verficado = 0;}
                   else{
                    $verficado = 1;
                   }
                $adelanto = New Abono();
                $adelanto->cliente_id =  $request->id;
                $adelanto->valor =  $abono['valor'];
                $adelanto->medio_pago_id  =  $abono['medio_pago_id'];
                $adelanto->cuenta_pago_id   =  $abono['cuenta_pago_id'];
                $adelanto->referencia_pago =  $abono['referencia_pago'];
                $adelanto->fecha_pago =  $abono['fecha_pago'];
                $adelanto->observaciones =  $abono['observaciones'];                
                $adelanto->estado =  'DISPONIBLE';  
                $adelanto->verificado =  $verficado;
                  
                if ($adelanto->save()) {
                    $auditoria = Auditoria::create([
                        'usuario' => auth()->user()->first_name,
                        'correo' => auth()->user()->email,
                        'observaciones' => 'Creacion de abono ' . $adelanto->id . ' por valor de: '.$abono['valor'].' para el cliente: '.$request->nombre_abono.'',
                        'direccion_ip' => $_SERVER['REMOTE_ADDR'],
                    ]);                  
            }
        }    
        $datos = $this->cargarDatos(); 
        return response()->json(['success' => true, 'message' => 'Abono creado exitosamente', 'datos' => $datos]);     
    }else {
        return response()->json(['success' => false, 'errors' => ['Ha ocurido un error al realizar el abono']]);               
                
            }
    }


    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return response()->json(['data' => $cliente]);
    }

    public function delete($id)
    {
        $cliente = Cliente::findOrFail($id);

        $auditoria = Auditoria::create([
            'usuario' => auth()->user()->first_name,
            'correo' => auth()->user()->email,
            'observaciones' => 'Eliminación de cliente ' . $cliente->documento . ' en la plataforma',
            'direccion_ip' => $_SERVER['REMOTE_ADDR'],
        ]);
        $cliente->delete();

        return response()->json(['success' => true, 'message' => 'Cliente Eliminado']);
    }

    public function changeState($id){
        $cliente = Cliente::findOrFail($id);
        if($cliente->estado){
           $cliente->estado = 0;
           $cliente->save();
           $datos = $this->cargarDatos();
           return response()->json(['success'=>true,'message'=>'Cliente Desactivado', 'datos' => $datos]); 
        }else{
            $cliente->estado = 1;
            $cliente->save();
            $datos = $this->cargarDatos();
           return response()->json(['success'=>true,'message'=>'Cliente Activado', 'datos' => $datos]); 
        }
        
      }
      public function viewAbonos($id){
        $abonos = Abono::select('abonos.id', 'abonos.valor', 'abonos.cliente_id', 'abonos.estado', 'abonos.verificado', 'abonos.referencia_pago', 'abonos.fecha_pago', 'medio_pago.medio_pago')
        ->join('medio_pago', 'medio_pago.id', '=', 'abonos.medio_pago_id')->where('abonos.cliente_id', $id)->whereIn('abonos.estado', ['DISPONIBLE','APARTADO'])->get();
        if($abonos->count() > 0){
            return response()->json(['success'=>true, 'datos' => $abonos]);
        }else{
            return response()->json(['success'=>false, 'datos' => null]);
        }

      }
    
      public function cuentasPagos($id){

        $cuentas = Cuentas::where('medio_pago_id', $id)->get();
        return response()->json(['data' => $cuentas]);

      }
      public function validateReferencia($ref){

        $cuentas = Abono::where('referencia_pago', $ref)->get();
        if($cuentas->count()>=1){
            return response()->json(['success' => true]);
        }else{
            return response()->json(['success' => false]);
        }
       

      }
      public function downloadTicket($id){

        $abono = Abono::select('abonos.id', 'abonos.valor', 'abonos.estado', 'abonos.verificado', 'abonos.referencia_pago', 'abonos.fecha_pago', 'clientes.nombres', 'clientes.apellidos', 'clientes.documento')
        ->join('clientes', 'clientes.id', '=', 'abonos.cliente_id')
        ->where('abonos.id', $id)
        ->get()->first();
                  
        $pdf = Pdf::loadView('exports.ticket', ['abono'=>$abono])->setPaper('b7', 'portrait');
        return $pdf->download("TICKET-ABONO-#$abono->id.pdf");


      }
    
}