<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Abono;
use App\Models\Cuentas;
use App\Models\MedioPago;
use Illuminate\Validation\Rule;
use App\Models\Auditoria;
use App\Models\Empresa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission as Permisos;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Mail;
use App\Mail\Notificaciones;


class UsersCompanyController extends Controller
{

    
    public function index(){          
         
        $roles = Role::whereIn('id',[4,5])->get();
        $empresa = Empresa::findOrFail(auth()->user()->empresa_id);
        $usuarios = $this->cargarDatos();          
        return view('livewire.users-company.index',compact('usuarios', 'empresa', 'roles'));        
       }

    public function cargarDatos() {
        $user = Auth::user();
        $roles = $user->getRoleNames();
         if ($roles->contains('SUPER-ADMIN')) {
            $datos = User::with('roles')->whereNotNull('empresa_id')->get();
         }else if($roles->contains('EMPRESA')){
            $datos = User::with('roles')->where('empresa_id', $user->empresa_id)->where('id', '<>', $user->id)->get();
         }else{
           $datos = [];
         }
       return $datos;
    }  
       

    public function store(Request $request){ 
        
        $validator = Validator::make($request->all(), [            
            'first_name' => 'required|max:20|regex:/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ ]{3,20}$/',
            'last_name' => 'required|max:20|regex:/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ ]{3,20}$/',
            'email' => ['required','max:80', 'email', Rule::unique('users', 'email')->ignore($request->id)->whereNull('deleted_at'), 'regex:/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z0-9\.]{1,12}$/'],
            'number' => 'required|digits_between:7,10',
            'role_id'=>['required']
        ],[
          'email.unique' => "El correo: ".$request->correo." ya se encuentra registrado"  
        ]);
    
        if($validator->fails()){
            //devuelve errores a la vista
         return response()->json([ 'success'=>false,'errors'=>$validator->errors()->all()]);
        }       
           
        if (!$request->id) {                     
             
            $password = $this->generateRandomString();
            $user = new User();
            $user->first_name = $request->first_name;
            $user->last_name  = $request->last_name;          
            $user->email    = $request->email;
            $user->password = Hash::make($password);
            $user->role_id    = $request->role_id;
            $user->estado  = 'ACTIVO';
            $user->number  = $request->number;
            $user->empresa_id  = $request->empresa_id;
           
           
                    
             if($user->save()){
                $user->assignRole($request->role_id);

                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones'=> 'Creacion de de usuario '. $request->email .' en la plataforma',
                    'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           
        
                ]);
    
                $detalleCorreo = [
                    'name' => $request->first_name, 
                    'usuario'=> $request->email, 
                    'password'=>$password,         
                    'Subject' => 'Notificacion de Registro Aplicativo CLUSTER PILOTO-BIM',
                    'modulo'=>'I'                     
                   
        
                ];
                Mail::to($request->email)->queue(new Notificaciones($detalleCorreo));
                
                $datos = $this->cargarDatos();
                return response()->json(['success'=>true,'message'=>'Usuario Creado Exitosamente','datos'=>$datos]);   
    
             }
            }else{
           
            $user = User::findOrFail($request->id);
            $user->first_name = $request->first_name;
            $user->last_name  = $request->last_name;          
            $user->email    = $request->email;         
            $user->role_id    = $request->role_id;    
            $user->number  = $request->number;
            $user->empresa_id  = $request->empresa_id;                      
            if($user->save()){
              $user->syncRoles([$request->role_id]);
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones'=> 'Actualizacion de usuario '. $request->email .' en la plataforma ',
                    'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           
        
                ]);
                   $datos = $this->cargarDatos(); 
                   return response()->json(['success'=>true,'message'=>'Usuario Actualizado Exitosamente !!','datos'=>$datos]);   
    
             }
    
        }
    
    
      }

      public function edit($id){
        $user = User::findOrFail($id);
        return response()->json(['data' => $user]);
      }
      public function desactivate($id){
        $user = User::findOrFail($id);
        $user->estado = 'INACTIVO';
        $user->save();     
        return response()->json(['message' =>"usuario $user->email desactivado exitosamente !!"]);
      }
      public function activate($id){
        $user = User::findOrFail($id);
        $user->estado = 'ACTIVO';
        $user->save();     
        return response()->json(['message' =>"usuario $user->email activado !!"]);
      }

      public function resetPassword($id){     
        
        $usuario = User::findOrfail($id);
        $password = $this->generateRandomString();      
        $usuario->update([
            'password' => Hash::make($password),
        ]);

        $auditoria = Auditoria::create([
            'usuario' => auth()->user()->first_name,
            'correo' => auth()->user()->email,
            'observaciones'=> 'Actualizacion de contraseña del usuario: '. $usuario->email .' en la plataforma',
            'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           

        ]);

        $detalleCorreo = [
            'name' => $usuario->first_name, 
            'usuario'=> $usuario->email, 
            'password'=>$password,         
            'Subject' => 'Restablecimiento de contraseña Piloto-BIM',                     
            'modulo'=>'U'

        ];
        Mail::to($usuario->email)->send(new Notificaciones($detalleCorreo));
        $datos = $this->cargarDatos(); 
        return response()->json(['success'=>true,'message'=>'Contraseña restablecida !!','datos'=>$datos]);   
       

        
    }
      

      public function delete($id){
        $user = User::findOrFail($id);        
        $auditoria = Auditoria::create([
         'usuario' => auth()->user()->first_name,
         'correo' => auth()->user()->email,
         'observaciones'=> 'Eliminación de usuario '. $user->id .' de usuario '.$user->email.' en la plataforma',
         'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           
 
     ]);
     $user->removeRole($user->role_id);
     $user->delete();         
         return response()->json(['success'=>true,'message'=>'Usuario Eliminado']); 
   }
     
   
   public function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
}
