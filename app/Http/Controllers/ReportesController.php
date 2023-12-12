<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Abono;
use App\Models\Seguimiento;
use App\Models\Proyecto;
use App\Models\Auditoria;
use App\Models\Empresa;
use App\Models\Hito;
use App\Models\Fase;
use App\Models\Metodologia;
use App\Models\Indicador;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportesController extends Controller
{

    public function index()
    {

        return view('livewire.reportes.indicadores');
    }

    public function cargarDatos()
    {
        $empresa_id = auth()->user()->empresa_id ? auth()->user()->empresa_id : '%';
        $indicadores = Indicador::where('empresa_id', 'LIKE', $empresa_id)->get()->count();
        $hitos = Hito::where('empresa_id', 'LIKE', $empresa_id)->get()->count();
        $fases = Fase::where('empresa_id',  'LIKE', $empresa_id)->get()->count();
        $metodologia = Metodologia::where('empresa_id',  'LIKE', $empresa_id)->where('estado', 1)->get()->count();
        $proyecto_inicializado = Proyecto::where('empresa_id',  'LIKE', $empresa_id)->where('estado', 1)->get()->count();
        $proyecto_finalizado = Proyecto::where('empresa_id',  'LIKE', $empresa_id)->where('estado', 2)->get()->count();


        return response()->json(['success' => true, 'indicadores' => $indicadores, 'hitos' => $hitos, 'fases' => $fases, 'metodologia' => $metodologia, 'proyecto_inicializado' => $proyecto_inicializado, 'proyecto_finalizado' => $proyecto_finalizado]);
    }
    public function indexReportes()
    {
        $empresa_id = auth()->user()->empresa_id ? auth()->user()->empresa_id : '%';
        $proyectos = Proyecto::whereIn('estado', [1, 2])->where('empresa_id',  'LIKE', $empresa_id)->get();
        return view('livewire.reportes.reportes', compact('proyectos'));
    }

    public function getReporte($id)
    {
        $proyectos = Proyecto::where('id', $id)
            ->with('seguimientos.detalles', 'metodologia', 'seguimientos.fase', 'seguimientos.hito', 'seguimientos.indicador')
            ->get();
        if ($proyectos->count() > 0) {
            return response()->json(['success' => true, 'datos' => $proyectos]);
        } else {
            return response()->json(['success' => false]);
        }
    }



    public function queryComisionAgrupada(Request $request)
    {


        $query = Comision::select(
            'servicio.servicio',
            'tallas.talla',
            DB::raw('SUM(procedimiento_profesional.comision) as suma_comision'),
            DB::raw('COUNT(*) as conteo')
        )
            ->join('pago_procedimiento', 'pago_procedimiento.id', '=', 'procedimiento_profesional.procedimiento_id')
            ->join('servicio', 'servicio.id', '=', 'pago_procedimiento.servicio_id')
            ->join('tallas', 'tallas.id', '=', 'pago_procedimiento.talla_id')
            ->where('procedimiento_profesional.profesional_id', $request->profesional)
            ->where('pago_procedimiento.estado', 'CERRADO')
            ->whereBetween('procedimiento_profesional.fecha', [$request->fecha_inicial, $request->fecha_fin])
            ->groupBy('servicio.servicio', 'tallas.talla')
            ->orderBy('servicio.servicio')
            ->orderBy('tallas.talla')
            ->get();

        $query2 = AdicionalComision::select(
            'servicios_adicionales.nombre',
            DB::raw('SUM(adicional_profesional.comision) as suma_comisiones'),
            DB::raw('COUNT(*) as cantidad_registros')
        )
            ->join('pago_adicionales', 'pago_adicionales.id', '=', 'adicional_profesional.adicional_id')
            ->join('servicios_adicionales', 'servicios_adicionales.id', '=', 'pago_adicionales.servicio_adicional_id')
            ->join('clientes', 'clientes.id', '=', 'pago_adicionales.cliente_id')
            ->where('adicional_profesional.profesional_id', $request->profesional)
            ->whereBetween('adicional_profesional.fecha', [$request->fecha_inicial, $request->fecha_fin])
            ->groupBy('servicios_adicionales.nombre')
            ->orderBy('servicios_adicionales.nombre')
            ->get();

        $profesional = Profesional::where('id', $request->profesional)->get()->first();

        if ((isset($query) && $query->count() > 0) || (isset($query2) && $query2->count() > 0)) {
            return response()->json(['success' => true, 'data' => $query, 'profesional' => $profesional, 'data2' => $query2]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function indexAdicionales()
    {
        $profesionales = Profesional::where('id', '<>', 1)->orderBy('nombres', 'ASC')->get();
        return view('livewire.reportes.comision_adicionales', compact('profesionales'));
    }

    public function queryComisionAdicionales(Request $request)
    {


        $query = AdicionalComision::select('adicional_profesional.id', 'adicional_profesional.adicional_id', 'adicional_profesional.comision', 'adicional_profesional.porcentaje', 'servicios_adicionales.nombre', 'clientes.nombres', 'clientes.apellidos', 'clientes.documento', 'pago_adicionales.created_at',  'pago_adicionales.valor_pagar')->join('pago_adicionales', 'pago_adicionales.id', '=', 'adicional_profesional.adicional_id')->join('servicios_adicionales', 'servicios_adicionales.id', '=', 'pago_adicionales.servicio_adicional_id')->join('clientes', 'clientes.id', '=', 'pago_adicionales.cliente_id')->where('adicional_profesional.profesional_id', $request->profesional)->whereBetween('adicional_profesional.fecha', [$request->fecha_inicial, $request->fecha_fin])->orderBy('adicional_profesional.id', 'DESC')->get();

        $profesional = Profesional::where('id', $request->profesional)->get()->first();

        if (isset($query) && $query->count() > 0) {
            return response()->json(['success' => true, 'data' => $query, 'profesional' => $profesional]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function indexCierre()
    {

        return view('livewire.reportes.cierre');
    }
    public function queryCierre(Request $request)
    {
        $abonos =  Abono::select(
            'cuentas_pago.entidad',
            'medio_pago.medio_pago',
            DB::raw('SUM(abonos.valor) as total'),
            DB::raw('COUNT(*) as cantidad')
        )
            ->join('medio_pago', 'medio_pago.id', '=', 'abonos.medio_pago_id')
            ->join('cuentas_pago', 'cuentas_pago.id', '=', 'abonos.cuenta_pago_id')
            ->whereBetween('abonos.fecha_pago', [$request->fecha_inicial, $request->fecha_fin])
            ->groupBy('medio_pago.medio_pago', 'cuentas_pago.entidad')
            ->orderBy('medio_pago.medio_pago')
            ->orderBy('cuentas_pago.entidad')
            ->get();
        $procedimientos =  Transferencia::select(
            'cuentas_pago.entidad',
            'medio_pago.medio_pago',
            DB::raw('SUM(transferencias_pago.valor) as total'),
            DB::raw('COUNT(*) as cantidad')
        )
            ->join('medio_pago', 'medio_pago.id', '=', 'transferencias_pago.medio_pago_id')
            ->join('cuentas_pago', 'cuentas_pago.id', '=', 'transferencias_pago.cuenta_pago_id')
            ->whereBetween('transferencias_pago.fecha', [$request->fecha_inicial, $request->fecha_fin])
            ->where('transferencias_pago.tipo', 'P')
            ->groupBy('medio_pago.medio_pago', 'cuentas_pago.entidad')
            ->orderBy('medio_pago.medio_pago')
            ->orderBy('cuentas_pago.entidad')
            ->get();

        $servicios =  Transferencia::select(
            'cuentas_pago.entidad',
            'medio_pago.medio_pago',
            DB::raw('SUM(transferencias_pago.valor) as total'),
            DB::raw('COUNT(*) as cantidad')
        )
            ->join('medio_pago', 'medio_pago.id', '=', 'transferencias_pago.medio_pago_id')
            ->join('cuentas_pago', 'cuentas_pago.id', '=', 'transferencias_pago.cuenta_pago_id')
            ->whereBetween('transferencias_pago.fecha', [$request->fecha_inicial, $request->fecha_fin])
            ->where('transferencias_pago.tipo', 'S')
            ->groupBy('medio_pago.medio_pago', 'cuentas_pago.entidad')
            ->orderBy('medio_pago.medio_pago')
            ->orderBy('cuentas_pago.entidad')
            ->get();

        if ((isset($abonos) && $abonos->count() > 0) || (isset($procedimientos) && $procedimientos->count() > 0) || (isset($servicios) && $servicios->count() > 0)) {
            return response()->json(['success' => true, 'data' => $abonos, 'data2' => $procedimientos, 'data3' => $servicios]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function indexProcedimientos()
    {

        $profesionales = Profesional::where('id', '<>', 1)->orderBy('nombres', 'ASC')->get();
        $clientes = Cliente::orderBy('nombres', 'ASC')->get();
        $servicios = Servicio::orderBy('servicio', 'ASC')->get();
        $tallas = Talla::all();
        $descuentos = Descuento::all();
        return view('livewire.reportes.reporte_procedimientos', compact('profesionales', 'clientes', 'servicios', 'tallas', 'descuentos'));
    }

    public function reporteProcedimientos(Request $request)
    {

        $pago = Pago::select('pago_procedimiento.id', 'pago_procedimiento.precio', 'pago_procedimiento.valor_pagar', 'pago_procedimiento.comision', 'pago_procedimiento.medio_pago', 'pago_procedimiento.estado', 'pago_procedimiento.created_at', 'clientes.nombres', 'clientes.apellidos', 'servicio.servicio', 'tallas.talla', 'abonos.valor', 'abonos.fecha_pago', 'planes_dcto.plan', 'profesionales.nombres as nombres_profesional', 'profesionales.apellidos as apellidos_profesional')->join('clientes', 'clientes.id', '=', 'pago_procedimiento.cliente_id')->join('servicio', 'servicio.id', '=', 'pago_procedimiento.servicio_id')->leftJoin('tallas', 'tallas.id', '=', 'pago_procedimiento.talla_id')->leftJoin('abonos', 'abonos.id', '=', 'pago_procedimiento.abonos_id')->leftJoin('planes_dcto', 'planes_dcto.id', '=', 'pago_procedimiento.planes_id')->leftJoin('procedimiento_profesional', 'procedimiento_profesional.procedimiento_id', '=', 'pago_procedimiento.id')->leftJoin('profesionales', 'profesionales.id', '=', 'procedimiento_profesional.profesional_id')->where('pago_procedimiento.cliente_id', 'LIKE', $request->cliente)
            ->where('pago_procedimiento.estado', 'CERRADO')
            ->where('pago_procedimiento.servicio_id', 'LIKE', $request->servicio)
            ->where('pago_procedimiento.talla_id', 'LIKE', $request->talla)
            ->whereRaw("IFNULL(pago_procedimiento.planes_id, '') LIKE ?", [$request->descuento])
            ->where('procedimiento_profesional.profesional_id', 'LIKE', $request->profesional)
            ->whereBetween(DB::raw("DATE(pago_procedimiento.created_at)"), [$request->fecha_inicial, $request->fecha_fin])
            ->orderBy('pago_procedimiento.id', 'DESC')
            ->limit(1000)
            ->get();


        if (isset($pago) && $pago->count() > 0) {
            return response()->json(['success' => true, 'datos' => $pago]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function indexServicios()
    {

        $profesionales = Profesional::where('id', '<>', 1)->orderBy('nombres', 'ASC')->get();
        $clientes = Cliente::orderBy('nombres', 'ASC')->get();
        $servicios = ServicioAdicional::orderBy('nombre', 'ASC')->get();

        return view('livewire.reportes.reporte_servicios', compact('profesionales', 'clientes', 'servicios'));
    }

    public function reporteServicios(Request $request)
    {

        $pago = PagoAdicional::select('pago_adicionales.id',  'pago_adicionales.valor_pagar', 'pago_adicionales.comision', 'pago_adicionales.medio_pago', 'pago_adicionales.created_at', 'clientes.nombres', 'clientes.apellidos', 'servicios_adicionales.nombre', 'profesionales.nombres as nombres_profesional', 'profesionales.apellidos as apellidos_profesional')->join('clientes', 'clientes.id', '=', 'pago_adicionales.cliente_id')->join('servicios_adicionales', 'servicios_adicionales.id', '=', 'pago_adicionales.servicio_adicional_id')->leftJoin('adicional_profesional', 'adicional_profesional.adicional_id', '=', 'pago_adicionales.id')->leftJoin('profesionales', 'profesionales.id', '=', 'adicional_profesional.profesional_id')
            ->where('pago_adicionales.cliente_id', 'LIKE', $request->cliente)
            ->where('pago_adicionales.servicio_adicional_id', 'LIKE', $request->servicio)
            ->where('adicional_profesional.profesional_id', 'LIKE', $request->profesional)
            ->whereBetween(DB::raw("DATE(pago_adicionales.created_at)"), [$request->fecha_inicial, $request->fecha_fin])
            ->orderBy('pago_adicionales.id', 'DESC')
            ->limit(1000)
            ->get();


        if (isset($pago) && $pago->count() > 0) {
            return response()->json(['success' => true, 'datos' => $pago]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
