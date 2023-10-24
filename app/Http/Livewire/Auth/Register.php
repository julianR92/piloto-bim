<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use App\Models\Municipio;
use App\Models\Auditoria;
use App\Models\Tarea;
use App\Models\Empresa;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\Notify;
use Illuminate\Validation\ValidationException;


class Register extends Component
{

    public $email = '';
    public $password = '';
    public $passwordConfirmation = '';
    public $nit = '';
    public $razon_social = '';
    public $nombres_representante = '';
    public $apellidos_representante = '';
    public $documento_representante = '';
    public $correo = '';
    public $telefono = '';
    public $direccion = '';
    public $codigo_muni = '';
    public $acepta_terminos = '';


    protected $rules = [
             'nit' => 'required|numeric|max:999999999999999|unique:empresas,nit',
            'razon_social' => 'required|string|max:50',
            'nombres_representante' => 'required|string|max:20|regex:/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ ]+$/',
            'apellidos_representante' => 'required|string|max:20|regex:/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ ]+$/',
            'documento_representante' => 'required|numeric|max:999999999999999',
            'correo' => 'required|unique:users,email|regex:/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{4,}\.[a-zA-Z0-9\.]{2,12}$/',
            'telefono' => 'required|numeric|max:9999999999',
            'direccion' => 'required|string|max:150',
            'codigo_muni' => 'required',
             'acepta_terminos' => 'required',
             'password' => [
                'required',
                'min:6',
                'regex:/^(?=.*[A-Z])(?=.*[!@#$%^&*()_+.,-])[A-Za-z\d!@#$%^&*()_+.,-]+$/'
            ],
            'passwordConfirmation' => 'required|same:password',
            
        ];
        protected $messages = [
            'password.regex' => 'La contraseña debe tener minimo una mayuscula y un caracter especial'
        ];

   

    public function mount()
    {
        if (auth()->user()) {
            return redirect()->intended('/dashboard');
        }
    }

   
    
    public function register()
    {
        try {
            $this->validate();
        } catch (ValidationException $e) {
            $errors = $e->errors();          
            $this->emit('hideLoad');          
            return;
        }     

       
       $empresa = New Empresa();
       $empresa->nit = $this->nit;
       $empresa->razon_social = $this->razon_social;
       $empresa->representante = $this->nombres_representante.' '.$this->apellidos_representante;
       $empresa->direccion = $this->direccion;
       $empresa->documento_representante = $this->documento_representante;
       $empresa->codigo_muni  = $this->codigo_muni;
       $empresa->correo  = $this->correo;
       $empresa->telefono  = $this->telefono;
       $empresa->acepta_terminos  = 1;

       if($empresa->save()){
          
         $user = User::create([
            'email' =>$this->correo,
            'password' => Hash::make($this->password),
            'remember_token' => Str::random(10),
            'first_name'=>$this->nombres_representante,
            'last_name'=>$this->apellidos_representante,
            'number'=>$this->telefono,
            'address'=>$this->direccion,
            'estado'=>'PENDIENTE',
            'role_id'=> 3,
            'empresa_id'=> $empresa->id,        
           
        ]);
        $user->assignRole(3);

        $auditoria = Auditoria::create([
            'usuario' => $this->correo,
            'correo' => $this->correo,
            'observaciones' => "Usuario $user->id creado en en la plataforma",
            'direccion_ip' => $_SERVER['REMOTE_ADDR'],
        ]);
        
        //asignar Tareas
        $tarea = Tarea::create([
            'tarea' => 'Activacion de usuario para ingreso',
            'de_user' => $this->correo,
            'rol' => 'ADMIN-CAMARA',           
            'realizado'  => 0         
           
        ]);



        $detalleCorreo = [
            'email' => $this->correo,           
            'Subject' => 'Registro Exitoso',  
            'password' => $this->password,  
            'razon' => $this->razon_social, 
            'tipo'=>'RE'      
        ];
          Mail::to($this->correo)->send(new Notify($detalleCorreo));
          $this->clearForm();
          $this->emit('hideLoad'); 
          $this->emit('alert', ['title' => 'Registro exitoso!', 'text' => 'Ahora debes esperar la autorizacion del administrador del cluster, te estaremos avisando no te preocupes 😎','icon'=>'success']);


       }else{
        $this->clearForm();
        $this->emit('hideLoad'); 
        $this->emit('alert', ['title' => 'Atencion!', 'text' => 'Tenemos inconvenientes intentalo mas tarde 🥴','icon'=>'error',]);

       }

    }

    public function render()
    {    
        $municipios = Municipio::where('codigo_depto', '68')->orderBy('municipio', 'ASC')->get();
        return view('livewire.auth.register', ['municipios' => $municipios]);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);

        // Actualiza la propiedad de validez correspondiente
    }

    public function clearForm(){
        $this->email = '';
        $this->password = '';
        $this->passwordConfirmation = '';
        $this->nit = '';
        $this->razon_social = '';
        $this->nombres_representante = '';
        $this->apellidos_representante = '';
        $this->documento_representante = '';
        $this->correo = '';
        $this->telefono = '';
        $this->direccion = '';
        $this->codigo_muni = '';
        $this->acepta_terminos = '';

    }
}
