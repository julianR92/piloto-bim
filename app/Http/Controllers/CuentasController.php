<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedioPago;
use App\Models\Auditoria;
use App\Models\Cuentas;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;


class CuentasController extends Controller
{
  public function index()
  {
    $medio_pago = MedioPago::all();
    $cuentas = $this->cargarDatos();
    return view('livewire.cuentas-pago.index', compact('medio_pago', 'cuentas'));
  }

  private function cargarDatos()
  {
    return Cuentas::select('cuentas_pago.id', 'cuentas_pago.entidad', 'cuentas_pago.numero_cuenta', 'cuentas_pago.estado', 'medio_pago.medio_pago')
      ->join('medio_pago', 'medio_pago.id', '=', 'cuentas_pago.medio_pago_id')
      ->orderBy('cuentas_pago.id', 'desc')
      ->get();
  }



  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'numero_cuenta' => 'required|max:30|unique:cuentas_pago,numero_cuenta,' . $request->id,
      'medio_pago_id' => 'required',
      'entidad'=>'required|max:20|string',
      'estado' => 'required'
    ]);

    if ($validator->fails()) {
      //devuelve errores a la vista
      return response()->json(['success' => false, 'errors' => $validator->errors()->all()]);
    }

    if (!$request->id) {
      $cuenta = new Cuentas();
      $cuenta->medio_pago_id = $request->medio_pago_id;
      $cuenta->entidad = $request->entidad;
      $cuenta->numero_cuenta = $request->numero_cuenta;
      $cuenta->estado = $request->estado;
      if ($cuenta->save()) {
        $auditoria = Auditoria::create([
          'usuario' => auth()->user()->first_name,
          'correo' => auth()->user()->email,
          'observaciones' => 'Creacion de cuenta de pago ' . $request->numero_cuenta . ' en la plataforma',
          'direccion_ip' => $_SERVER['REMOTE_ADDR'],
        ]);

        $datos = $this->cargarDatos();
        return response()->json(['success' => true, 'message' => 'Cuenta de Pago Creada Exitosamente', 'datos' => $datos]);
      }
    } else {
      $cuenta = Cuentas::findOrFail($request->id);
      $cuenta->medio_pago_id = $request->medio_pago_id;
      $cuenta->entidad = $request->entidad;
      $cuenta->numero_cuenta = $request->numero_cuenta;
      $cuenta->estado = $request->estado;
      if ($cuenta->save()) {
        $auditoria = Auditoria::create([
          'usuario' => auth()->user()->first_name,
          'correo' => auth()->user()->email,
          'observaciones' => 'Actualizacion de cuenta ' . $request->numero_cuenta . ' en la plataforma',
          'direccion_ip' => $_SERVER['REMOTE_ADDR'],
        ]);
        $datos = $this->cargarDatos();
        return response()->json(['success' => true, 'message' => 'Cuenta de Pago Actualizada Exitosamente', 'datos' => $datos]);
      }
    }
  }

  public function edit($id)
  {
    $cuenta = Cuentas::findOrFail($id);
    return response()->json(['data' => $cuenta]);
  }

  public function delete($id)
  {
    $cuenta = Cuentas::findOrFail($id);

    $auditoria = Auditoria::create([
      'usuario' => auth()->user()->first_name,
      'correo' => auth()->user()->email,
      'observaciones' => 'Eliminación de cuenta de pago ' . $cuenta->numero_cuenta . ' en la plataforma',
      'direccion_ip' => $_SERVER['REMOTE_ADDR'],
    ]);
    $cuenta->delete();

    return response()->json(['success' => true, 'message' => 'Cuenta de pago Eliminada']);
  }
}
