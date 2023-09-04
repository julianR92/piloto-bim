<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;
use App\Models\Auditoria;

class Profile extends Component
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

    public function rules() {

        return [
            'first_name' => 'required|max:10|regex:/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ ]{3,20}$/',
            'last_name' => 'required|max:10|regex:/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ ]{3,20}$/',
            'email' => ['required','max:80', 'email', Rule::unique('users', 'email')->ignore($this->idUser), 'regex:/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z0-9\.]{2,12}$/'],
            'number' => 'required|digits_between:7,10',
            'gender' => [Rule::in(['Mujer', 'Hombre', 'Intergenero','Otro'])],
            'address' => 'max:100|regex:/^[a-zA-Z0-9\-#\s. ]{5,100}$/',          
            'city' => 'max:20',
           
        ];
    }

    public function render()
    {
        return view('livewire.profile');
    }
    public function mount() { 

        $this->first_name = auth()->user()->first_name;
        $this->last_name = auth()->user()->last_name;
        $this->email = auth()->user()->email;
        $this->number = auth()->user()->number;
        $this->city = auth()->user()->city;
        $this->gender = auth()->user()->gender;
        $this->address = auth()->user()->address;
        $this->idUser = auth()->user()->id;
        
    }

    public function updated($campo)
    {
        $this->validateOnly($campo);
    }

   

    public function save()
    {
        $this->validate();
        $username =  User::findOrFail($this->idUser);
        $username->first_name = $this->first_name;
        $username->last_name = $this->last_name;
        $username->email  = $this->email;      
        $username->number = $this->number; 
        $username->city = $this->city; 
        $username->gender = $this->gender; 
        $username->address = $this->address;
        
        if ($username->save()){

            $auditoria = Auditoria::create([
                'usuario' => auth()->user()->first_name,
                'correo' => auth()->user()->email,
                'observaciones'=> 'Actualizacion  de perfil de usuario '. $this->email .' en la plataforma',
                'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           
    
            ]);

            $this->resetErrorBag();
            $this->resetValidation();
            $this->resetExcept('user');           
            $this->emit('toast-info', ['title' => 'Proceso exitoso!', 'text' => 'Perfil Actualizado','icon'=>'success']);
            $this->first_name = $username->first_name;
            $this->last_name = $username->last_name;
            $this->email = $username->email;
            $this->number = auth()->user()->number;
            $this->city = $username->city;
            $this->gender = $username->gender;
            $this->address = $username->address;
            $this->idUser = $username->id;
                
        }
    }

}
