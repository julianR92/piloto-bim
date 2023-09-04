<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profesional;
use Illuminate\Support\Facades\Validator;
use App\Models\Auditoria;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\Notificaciones;


class ProfesionalController extends Controller
{
    public function index(){

        $profesional = Profesional::all();     
        return view('livewire.profesionales.index',compact('profesional'));        
       }

    public function create(){
        $titulo = 'Creación de Profesional';
        $butttonMessage = 'Crear Profesional';
        return view('livewire.profesionales.create', compact('titulo','butttonMessage'));
    }

    public function store(Request $request){ 
        
        $validator = Validator::make($request->all(), [
            'nombres' => 'required|max:20',
            'cargo' => 'required|max:20',
            'direccion'=>'required|max:100',
            'apellidos' => 'required|max:20',           
            'documento' => 'required|max:15|unique:profesionales,documento,'. $request->id,
            'celular'=>'digits_between:7,10',
            'correo'=>['required','unique:profesionales,correo,'. $request->id,'unique:users,email,'. $request->user_id],
            

        ]);
    
        if($validator->fails()){
            //devuelve errores a la vista
         return response()->json([ 'success'=>false,'errors'=>$validator->errors()->all()]);
        }
       
    
        if(!$request->id){
           
            $password = $this->generateRandomString();

            $username = new User();
            $username->first_name = $request->nombres;
            $username->last_name = $request->apellidos;
            $username->email  = $request->correo;      
            $username->number= $request->celular;
            $username->password = Hash::make($password);
            $username->role_id = 3;
            $username->city = 'BUCARAMANGA';
            $username->estado   = 1;           
             if($username->save()){
                $username->assignRole(3);
                $profesional = new Profesional();
                $profesional->nombres = $request->nombres;
                $profesional->apellidos = $request->apellidos;
                $profesional->direccion = $request->direccion;
                $profesional->documento = $request->documento;
                $profesional->celular = $request->celular;
                $profesional->correo = $request->correo;
                $profesional->cargo = $request->cargo;
                $profesional->user_id = $username->id;
                $profesional->save();
                
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones'=> 'Creacion de Profesional '.$request->nombres.' '.$request->apellidos.' en la plataforma',
                    'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           
        
                ]);
                $detalleCorreo = [
                    'name' => $request->nombres, 
                    'usuario'=> $request->correo, 
                    'password'=>$password,         
                    'Subject' => 'Notificacion de Registro en Aplicativo SOS',
                    'modulo'=>'I'                    
                          
                ];
                Mail::to($request->correo)->queue(new Notificaciones($detalleCorreo));
                return response()->json(['success'=>true,'message'=>'Profesional Creado Exitosamente']);   
    
             }
        }else{

            $username = User::findOrFail($request->user_id);
            $username->first_name = $request->nombres;
            $username->last_name = $request->apellidos;
            $username->email  = $request->correo;      
            $username->number= $request->celular;
            if($username->save()){
               
                $docente = Profesional::findOrFail($request->id);
                $docente->nombres = $request->nombres;
                $docente->apellidos = $request->apellidos;
                $docente->direccion = $request->direccion;
                $docente->documento = $request->documento;
                $docente->celular = $request->celular;
                $docente->correo = $request->correo;
                $docente->cargo = $request->cargo;               
                $docente->save();
                
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones'=> 'Actualización de Profesional '.$request->nombres.' '.$request->apellidos.' en la plataforma',
                    'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           
        
                ]);
                
                return response()->json(['success'=>true,'message'=>'Profesional Actualizado']);   
    
             }
    
        }
    
    
      }

      public function edit($id){
        $datos = Profesional::findOrFail($id);
        $titulo = 'Actualizacion de docentes';
        $butttonMessage = 'Actualizar Docente';
        return view('livewire.profesionales.create', compact('titulo','butttonMessage','datos'));
      }

      public function delete($id)
    {
        $profesional = Profesional::findOrFail($id);

        $auditoria = Auditoria::create([
            'usuario' => auth()->user()->first_name,
            'correo' => auth()->user()->email,
            'observaciones' => 'Eliminación de profesional '.$profesional->nombres.' '.$profesional->apellidos.' en la plataforma',
            'direccion_ip' => $_SERVER['REMOTE_ADDR'],
        ]);
        $user = User::findOrFail($profesional->user_id);
        $profesional->delete();
        if($user){
            $user->syncRoles([]);
            $user->syncPermissions([]);
            $user->forceDelete();
        }

        return response()->json(['success' => true, 'message' => 'Profesional Eliminado']);
    }

      function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
}
