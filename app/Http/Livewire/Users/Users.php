<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use Spatie\Permission\Models\Permission as Permisos;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;
use App\Models\Auditoria;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\Notificaciones;

class Users extends Component
{
    protected $listeners = [
        'editPermission',
        'limpiarCampos',
        'eliminar',
        'showRoles', 
        'refreshParent' => '$refresh',
        'resetPassword',
        'changeState',
        'showPermisos'
        
    ];

    public User $user;
    public $first_name;
    public $last_name;
    public $email;
    public $number;
    public $roles;
    public $titulo = 'Crear Usuarios';
    public $btnButton = 'Crear';
    public $idUser='';
    public $password;
    public $permisos =[];
   

    protected $messages = [
        'email.unique' => 'Este usuario ya se encuentra registrado'
    ];


    protected function rules()
    {
        return [
            'first_name' => 'required|max:20|regex:/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ ]{3,20}$/',
            'last_name' => 'required|max:20|regex:/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ ]{3,20}$/',
            'email' => ['required','max:80', 'email', Rule::unique('users', 'email')->ignore($this->idUser)->whereNull('deleted_at'), 'regex:/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z0-9\.]{2,12}$/'],
            'number' => 'required|digits_between:7,10',
            'roles'=>['required']
            
            
        ];
    }

    public function limpiarCampos(){
        $this->titulo = 'Crear Usuarios';
        $this->btnButton = 'Crear';
        $this->roles ='';
        $this->idUser ='';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->resetExcept('user');
    }

    public function render()
    {   $usuario = User::findOrFail(auth()->user()->id);        
        if($usuario->getRoleNames()[0] == 'ADMIN'){
            $data =  Role::where('name','!=','SUPER-ADMIN')->get();
            $permissions = Permisos::get();
            return view('livewire.users.users', compact('data','permissions'));
        }else{
            $data =  Role::get();
            $permissions = Permisos::get();
            return view('livewire.users.users', compact('data', 'permissions'));
        }
     
    }

   
    public function mount(User $user){
      
        $this->user = $user;          
     
    }

   
    public function updated($campo)
    {
        $this->validateOnly($campo);
    }

    public function guardar(){

        $this->password = $this->generateRandomString();
        $this->validate();
        if($this->idUser){
        $username =  User::findOrFail($this->idUser);
        $username->first_name = $this->first_name;
        $username->last_name = $this->last_name;
        $username->email  = $this->email;      
        $username->number= $this->number;       
        $username->role_id = $this->roles;

        if ($username->save()){
            $username->syncRoles($this->roles);
        }
        $auditoria = Auditoria::create([
            'usuario' => auth()->user()->first_name,
            'correo' => auth()->user()->email,
            'observaciones'=> 'Actualizacion  de usuario '. $this->email .' en la plataforma',
            'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           

        ]);

        $this->resetErrorBag();
        $this->resetValidation();
        $this->resetExcept('user');
        $this->emitTo('permisos-table', 'updateTable');
        $this->emit('toast', ['title' => 'Proceso exitoso!', 'text' => 'Usuario Actualizado','icon'=>'success']);       
            

        }else{
        $username = new User();
        $username->first_name = $this->first_name;
        $username->last_name = $this->last_name;
        $username->email  = $this->email;
        $username->password = Hash::make($this->password);
        $username->number= $this->number;
        $username->city = 'BUCARAMANGA';
        $username->role_id = $this->roles;
        $username->estado = 1;
        if ($username->save()){
        $username->assignRole($this->roles);

        $auditoria = Auditoria::create([
                        'usuario' => auth()->user()->first_name,
                        'correo' => auth()->user()->email,
                        'observaciones'=> 'Creacion de de usuario '. $this->email .' en la plataforma',
                        'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           
            
                    ]);
        
                    $detalleCorreo = [
                        'name' => $this->first_name, 
                        'usuario'=> $this->email, 
                        'password'=>$this->password,         
                        'Subject' => 'Notificacion de Registro Aplicativo EMA',
                        'modulo'=>'I'                     
                       
            
                    ];
                    Mail::to($this->email)->queue(new Notificaciones($detalleCorreo));

        $this->resetErrorBag();
        $this->resetValidation();
        $this->resetExcept('user');
        $this->emitTo('permisos-table', 'updateTable');
        $this->emit('toast', ['title' => 'Proceso exitoso!', 'text' => 'Usuario Creado','icon'=>'success']);
        }
        
       
        }         
      
      
        
    }
    public function editPermission(User $user){
        $this->titulo = 'Editar Usuario';
        $this->btnButton = 'Editar';
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;
        $this->number = $user->number;
        $this->roles = $user->role_id;      
        $this->idUser = $user->id;
                         
        $this->dispatchBrowserEvent('edit-modal', ['idModal' => 'modalSignIn']);
        
    }
    

    public function eliminar(User $user) {
    
        $auditoria = Auditoria::create([
            'usuario' => auth()->user()->first_name,
            'correo' => auth()->user()->email,
            'observaciones'=> 'Eliminación del usuario '. $user->email .' en la plataforma',
            'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           

        ]);

            $user->delete();
            $this->emitTo('permisos-table', 'updateTable');
            // $this->emit('toast', ['title' => 'Proceso exitoso!', 'text' => 'Rol Eliminado','icon'=>'success']);
           
    }

    public function showRoles(User $user){
        
        $role = Role::find($user->role_id);
        $this->dispatchBrowserEvent('dataRoles',['rol' => $role->name,'usuario'=>$user->first_name, 'idModal'=>'modalPermisos']);    
             

    }

    public function resetPassword(User $user){

        $this->password = $this->generateRandomString();
        $usuario = $user;
        $user->update([
            'password' => Hash::make($this->password),
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
            'password'=>$this->password,         
            'Subject' => 'Restablecimiento de contraseña Aplicativo SOS',                     
            'modulo'=>'U'

        ];
        Mail::to($usuario->email)->queue(new Notificaciones($detalleCorreo));
        $this->emitTo('permisos-table', 'updateTable');
        // $this->redirectRoute('user.index');

        
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

    public function changeState(User $user){

        $usuario = $user;
       if($user->estado){       
            $user->update([
            'estado'=> 0
        ]);
        $auditoria = Auditoria::create([
            'usuario' => auth()->user()->first_name,
            'correo' => auth()->user()->email,
            'observaciones'=> 'Usuario : '. $usuario->email .' desactivado en la plataforma',
            'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           

        ]);

        $this->emit('toast-info', ['title' => 'Proceso exitoso!', 'text' => 'Usuario Desactivado','icon'=>'success']);
      
       }else{
        $user->update([
            'estado'=>1
        ]);
        $auditoria = Auditoria::create([
            'usuario' => auth()->user()->first_name,
            'correo' => auth()->user()->email,
            'observaciones'=> 'Usuario: '. $usuario->email .'activado en la plataforma',
            'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           

        ]);
        $this->emit('toast-info', ['title' => 'Proceso exitoso!', 'text' => 'Usuario Activado','icon'=>'success']);

       

       }
    }

    public function showPermisos(User $user){
        
        $this->titulo = 'Editar Permisos';
        $this->btnButton = 'Editar Permisos';      
        $this->idUser = $user->id;

        $usuarios_permisos = [];
        $user= User::findOrFail($this->idUser);  
        $arrayPermisos= $user->getDirectPermissions();
        foreach($arrayPermisos as $permiso){
            $usuarios_permisos[] = $permiso->id;
        }
   
                         
        $this->dispatchBrowserEvent('setDataSelected',['permission' => $usuarios_permisos]);    
        $this->dispatchBrowserEvent('edit-modal', ['idModal' => 'permissionModal']);
        
    }

    public function guardarPermisos(){
        
        $user = User::findOrFail($this->idUser);   
         
       if($user->syncPermissions($this->permisos)){       
        $this->emit('toast-per', ['title' => 'Proceso exitoso!', 'text' => 'Permisos Actualizados','icon'=>'success']);       
        
       }else{       
        $this->emit('toast-per', ['title' => 'Ocurrio un Error!', 'text' => 'Problemas al actualizar los permisos','icon'=>'error']);
    }

 

    }
   


    
}
