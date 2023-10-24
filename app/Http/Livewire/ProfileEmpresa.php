<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Empresa;
use App\Models\Municipio;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;
use App\Models\Auditoria;

class ProfileEmpresa extends Component
{   
    public User $user;
    public $first_name = '';
    public $email = '';
    public $number = '';
    public $last_name = '';
    public $city = '';
    public $gender = '';
    public $address = '';
    public $idUser = '';
    public $showSavedAlert = false;
    public $showDemoNotification = false;
    public $razon_social= '';
    public $documento_representante= '';
    public $nit = '';
    public $idEmpresa = '';

    public function rules() {

        return [
            'nit' => ['required','numeric','max:999999999999999',Rule::unique('empresas', 'nit')->ignore($this->idEmpresa)],
            'razon_social' => 'required|string|max:50',
            'documento_representante' => 'required|numeric|max:999999999999999',
            'first_name' => 'required|max:20|regex:/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ ]{3,20}$/',
            'last_name' => 'required|max:20|regex:/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ ]{3,20}$/',
            'email' => ['required','max:80', 'email', Rule::unique('users', 'email')->ignore($this->idUser), 'regex:/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z0-9\.]{2,12}$/'],
            'number' => 'required|digits_between:7,10',
            'gender' => [Rule::in(['Mujer', 'Hombre', 'Intergenero','Otro'])],
            'address' => 'max:100|regex:/^[a-zA-Z0-9\-#\s. ]{5,100}$/',          
            'city' => 'required|max:20',
           
        ];
    }

    public function render()
    {    
        $municipios = Municipio::where('codigo_depto', '68')->orderBy('municipio', 'ASC')->get();
        return view('livewire.profile-empresa', ['municipios' => $municipios]);
    }

    public function mount() { 

        $empresa = Empresa::findOrFail(auth()->user()->empresa_id);    

        $this->first_name = auth()->user()->first_name;
        $this->last_name = auth()->user()->last_name;
        $this->email = auth()->user()->email;
        $this->number = auth()->user()->number;
        $this->city = $empresa->codigo_muni;
        $this->gender = auth()->user()->gender;
        $this->address = auth()->user()->address;
        $this->idUser = auth()->user()->id;
        $this->razon_social = $empresa->razon_social;
        $this->documento_representante = $empresa->documento_representante;
        $this->nit = $empresa->nit;
        $this->idEmpresa = $empresa->id;
        
        
    }

    public function updated($campo)
    {
        $this->validateOnly($campo);
    }

   

    public function save()
    {
        $this->validate();
        $username =  User::findOrFail($this->idUser);
        $municipio = Municipio::where('codigo_muni', $this->city)->get()->first();
        $username->first_name = $this->first_name;
        $username->last_name = $this->last_name;
        $username->email  = $this->email;      
        $username->number = $this->number; 
        $username->city = $municipio->municipio; 
        $username->gender = $this->gender; 
        $username->address = $this->address;
        
        if ($username->save()){
            $empresa = Empresa::FindOrFail(auth()->user()->empresa_id);
            $empresa->nit = $this->nit;
            $empresa->razon_social = $this->razon_social;
            $empresa->representante = $this->first_name.' '.$this->last_name;
            $empresa->documento_representante = $this->documento_representante;
            $empresa->direccion = $this->address;
            $empresa->codigo_muni  = $this->city;       
            $empresa->telefono  = $this->number;
            $empresa->save();      



            $auditoria = Auditoria::create([
                'usuario' => auth()->user()->first_name,
                'correo' => auth()->user()->email,
                'observaciones'=> 'Actualizacion  de perfil de usuario '. $this->email .' y empresa'.$this->razon_social. 'en la plataforma',
                'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           
    
            ]);

            $this->resetErrorBag();
            $this->resetValidation();
            $this->resetExcept('user');           
            $this->emit('toast-info', ['title' => 'Proceso exitoso!', 'text' => 'Empresa Actualizada','icon'=>'success']);
            $this->first_name = $username->first_name;
            $this->last_name = $username->last_name;
            $this->email = $username->email;
            $this->number = auth()->user()->number;
            $this->city = $username->city;
            $this->gender = $username->gender;
            $this->address = $username->address;
            $this->razon_social = $empresa->razon_social;
            $this->documento_representante = $empresa->documento_representante;
            $this->nit = $empresa->nit;
            $this->idUser = $username->id;
                
        }
    }
}
