<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auditoria;
use App\Models\TipoServicio;
use App\Models\Servicio;
use App\Models\Cliente;
use App\Models\Agenda;
use App\Models\Abono;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Config;


use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Calculation\Web\Service;

class AgendaController extends Controller
{

    public function index()
    {
        $today = date('Y-m-d');
        $data = $this->cargarDatos($today);
        $tipo_servicio = TipoServicio::all();
        $horarios_mañana = Config::get('global.horarios.mañana'); 
        $horarios_tarde = Config::get('global.horarios.tarde'); 
        $horarios_full = Config::get('global.horarios.full_time'); 
        $clientes = Cliente::where('estado', 1)->get();

        return view('livewire.agenda.index', compact('data','tipo_servicio','horarios_mañana','horarios_tarde', 'clientes', 'horarios_full'));
    }

    private function cargarDatos($fecha)
    {
        return Agenda::select('agenda.id', 'agenda.hora', 'agenda.fecha', 'agenda.estado', 'agenda.observacion','agenda.tipo_servicio_id', 'tipo_servicio.tipo_servicio', 'servicio.servicio', 'clientes.nombres','clientes.apellidos','clientes.telefono','clientes.instagram', 'abonos.valor')
            ->leftJoin('clientes', 'clientes.id', '=', 'agenda.cliente_id')
            ->leftJoin('tipo_servicio', 'tipo_servicio.id', '=', 'agenda.tipo_servicio_id')
            ->leftJoin('servicio', 'servicio.id', '=', 'agenda.servicio_id')
            ->leftJoin('abonos', 'abonos.id', '=', 'agenda.abono_id')
            ->where('agenda.fecha', $fecha)
            ->whereIn('agenda.estado', ['DISPONIBLE','AGENDADO'])
            ->orderBy('tipo_servicio.tipo_servicio', 'asc')
            ->orderBy('agenda.hora', 'desc')
            ->get();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'tipo_servicio_id' => 'required',
            'servicios_mañana' => 'required_unless:horarios_mañana,null|required_without:servicios_tarde',
            'horarios_mañana' => 'required_unless:servicios_mañana,null',
            'servicios_tarde' => 'required_unless:horarios_tarde,null|required_without:servicios_mañana',
            'horarios_tarde' => 'required_unless:servicios_tarde,null',
            
            
        ]);

        if ($validator->fails()) {
            //devuelve errores a la vista
            return response()->json(['success' => false, 'errors' => $validator->errors()->all()]);
        }

        $fecha_fin = Carbon::parse($request->fecha_fin);
        $fecha_inicio = Carbon::parse($request->fecha_inicio);
        $diff_dates = $fecha_fin->diffInDays($fecha_inicio);

        for ($i = 0; $i <= intval($diff_dates); $i++) {            
            $date_1 = date("Y-m-d", strtotime($request->fecha_inicio . "+ $i days"));
            // //servicios en la mañana
            if($request->servicios_mañana){
                for($j = 1; $j <=intval($request->servicios_mañana); $j++){
                 $agenda_mañana = new Agenda();
                 $agenda_mañana->fecha = $date_1;
                 $agenda_mañana->hora = $request->horarios_mañana;                
                 $agenda_mañana->tipo_servicio_id = $request->tipo_servicio_id;
                 $agenda_mañana->estado = 'DISPONIBLE';
                 $agenda_mañana->save();
                 
                }
            }
            //servicios en la tarde
            if($request->servicios_tarde){
                for($k = 1; $k <=intval($request->servicios_tarde); $k++){
                    $agenda_tarde = new Agenda();
                    $agenda_tarde->fecha = $date_1;
                    $agenda_tarde->hora = $request->horarios_tarde;                
                    $agenda_tarde->tipo_servicio_id = $request->tipo_servicio_id;
                    $agenda_tarde->estado = 'DISPONIBLE';
                    $agenda_tarde->save();
                }
            }
        }
           
        $data = $this->cargarDatos(date('Y-m-d'));
        return response()->json(['success' => true, 'message' => 'Agenda Creada exitosamente','data' => $data]);

        
    }
    public function assignAgenda(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cliente_id' => 'required',
            'tipo_servicio_id_agenda' => 'required',
            'servicio_id' => 'required',
            'horarios_full' => 'required',
            'abono_id' => 'required',
            'agenda_id' => 'required',
            'observacion' => 'string|nullable',
            
            
        ]);

        if ($validator->fails()) {
            //devuelve errores a la vista
            return response()->json(['success' => false, 'errors' => $validator->errors()->all()]);
        }

         //abono

         $abono= Abono::where('id', $request->abono_id)->update([
             'estado' => 'APARTADO'
         ]);
            $cliente = Cliente::findOrFail($request->cliente_id);
            $agenda = Agenda::findOrFail($request->agenda_id);
            $agenda->hora = $request->horarios_full;
            $agenda->tipo_servicio_id  = $request->tipo_servicio_id_agenda;
            $agenda->servicio_id = $request->servicio_id;
            $agenda->cliente_id  = $request->cliente_id;
            $agenda->abono_id   = $request->abono_id;
            $agenda->estado   = 'AGENDADO';
            $agenda->observacion = $request->observacion;
            if ($agenda->save()) {
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Asignacion de cita #' . $agenda->id . ' al cliente '.$request->cliente_id.' en la plataforma',
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],
                ]);
                
                return response()->json(['success' => true, 'message' => 'Cita #'.$agenda->id.' asignada exitosamente al cliente: '.$cliente->nombres.' '.$cliente->apellidos]);
            }
        
        

        
    }
    public function editAgenda(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'agenda_id_edit' => 'required',
            'observacion_editar' => 'required|max:200',
            'estado_abono' => 'required',
            
            
        ]);

        if ($validator->fails()) {
            //devuelve errores a la vista
            return response()->json(['success' => false, 'errors' => $validator->errors()->all()]);
        }

         //abono

         
            $agenda = Agenda::findOrFail($request->agenda_id_edit);
            $agenda->estado   = $request->estado_abono;
            $agenda->observacion = $request->observacion_editar;
            if ($agenda->save()) {
                $abono= Abono::where('id', $agenda->abono_id)->update([
                    'estado' => 'DISPONIBLE'
                ]);
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Edicion de cita #' . $agenda->id . ' en la plataforma cambia a estado: '.$request->estado_abono,
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],
                ]);
                
                return response()->json(['success' => true, 'message' => 'Cita #'.$agenda->id.' cambia a estado :'.$request->estado_abono ]);
            }
        
        

        
    }

    public function edit($fecha)
    {
      
            $data = $this->cargarDatos($fecha);
            if ($data) {
                return response()->json(['response' => true, 'data' => $data]);
            } else {
                return response()->json(['response' => false, 'data' => $data]);
            }
        
    }

    public function getServicios($tipo)
    {
      $servicio = Servicio::where('tipo_servicio_id', $tipo)->get();
      if ($servicio) {
        return response()->json(['success' => true, 'data' => $servicio]);
    } else {
        return response()->json(['success' => false, 'data' => $servicio]);
    }
    }
    public function getAbonos($cliente_id)
    {
      $abonos = Abono::where('cliente_id', $cliente_id)->where('estado', 'DISPONIBLE')->where('verificado', 1)->get();
      if ($abonos->count()>0) {
        return response()->json(['success' => true, 'data' => $abonos]);
    } else {
        return response()->json(['success' => false]);
    }
    }

    public function delete($id)
    {
        $tipo = TipoServicio::findOrFail($id);

        $auditoria = Auditoria::create([
            'usuario' => auth()->user()->first_name,
            'correo' => auth()->user()->email,
            'observaciones' => 'Eliminación de Tipo de Servicio ' . $tipo->tipo_servicio . ' en la plataforma',
            'direccion_ip' => $_SERVER['REMOTE_ADDR'],
        ]);
        $tipo->delete();

        return response()->json(['success' => true, 'message' => 'Tipo de Servicio Eliminado']);
    }
}
