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

class TransferenciasController extends Controller
{
    public function index()
    {
        $transferencias = $this->cargarDatos();       
        return view('livewire.transferencias.index', compact('transferencias'));
    }

    public function cargarDatos(){
     
        return Abono::select('abonos.id','abonos.valor', 'abonos.medio_pago_id', 'abonos.cliente_id','abonos.estado', 'abonos.referencia_pago','abonos.fecha_pago','abonos.verificado','abonos.created_at' , 'clientes.nombres', 'clientes.apellidos', 'clientes.documento', 'medio_pago.medio_pago', 'cuentas_pago.entidad')
        ->join('clientes', 'clientes.id','abonos.cliente_id')
        ->join('medio_pago', 'medio_pago.id','abonos.medio_pago_id')
        ->join('cuentas_pago', 'cuentas_pago.id','abonos.cuenta_pago_id')
        ->where('abonos.medio_pago_id', 2)
        ->orderBy('abonos.created_at', 'DESC')
        ->get();

    }

    public function verificarPago($id){
        $abono = Abono::findOrFail($id);
        $abono->verificado = 1;
        if ($abono->save()) {
            $auditoria = Auditoria::create([
                'usuario' => auth()->user()->first_name,
                'correo' => auth()->user()->email,
                'observaciones' => 'Abono # ' . $abono->id . ' verificado en la plataforma',
                'direccion_ip' => $_SERVER['REMOTE_ADDR'],

            ]);
            $datos  = $this->cargarDatos();
            return response()->json(['success' => true, 'message' => "Pago #$id verificado", 'datos' => $datos]);
        }

    }
    public function unVerificarPago($id){
        $abono = Abono::findOrFail($id);
        $abono->verificado = 0;
        if ($abono->save()) {
            $auditoria = Auditoria::create([
                'usuario' => auth()->user()->first_name,
                'correo' => auth()->user()->email,
                'observaciones' => 'Abono # ' . $abono->id . ' verificado en la plataforma',
                'direccion_ip' => $_SERVER['REMOTE_ADDR'],

            ]);
            $datos  = $this->cargarDatos();
            return response()->json(['success' => true, 'message' => "Pago #$id No verificado", 'datos' => $datos]);
        }

    }    
   

  

}
