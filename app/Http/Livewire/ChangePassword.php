<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Auditoria;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ChangePassword extends Component
{

    public $password_now = '';
    public $password = '';
    public $password_confirm = '';
    
    
    public function render()
    {
        return view('livewire.change-password');
    }

    public function rules() {

        return [
            'password_now' => [
                'required',
                'min:6'
                
            ],
            'password' => 'required|min:6|regex:/^(?=.*[A-Z])(?=.*[!@#$%^&*()_+.,-])[A-Za-z\d!@#$%^&*()_+.,-]+$/',
            'password_confirm'=>'required|same:password|min:6'
           
        ];
    }

    public function updated($campo)
    {
        $this->validateOnly($campo);
    }
    public function validatePassword(){
         
        if (!Hash::check($this->password_now, auth()->user()->password)) {
            $this->addError('password_now','Contraseña Incorrecta');
            $this->password_now = '';         
           
        }
    }
    public function save()
    {
      $this->validate();
      $user = User::findOrFail(auth()->user()->id);
      $user->password = Hash::make($this->password);
      if($user->save()) {
        $auditoria = Auditoria::create([
            'usuario' => auth()->user()->first_name,
            'correo' => auth()->user()->email,
            'observaciones'=> 'Actualizacion de contraseña '. auth()->user()->email .' en la plataforma',
            'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           

        ]);
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset('password_now','password', 'password_confirm');
        $this->emit('toast-info', ['title' => 'Proceso exitoso!', 'text' => 'Contraseña Actualizada','icon'=>'success']);
      }
    }
    
}
