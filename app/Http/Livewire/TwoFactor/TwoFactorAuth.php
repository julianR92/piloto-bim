<?php

namespace App\Http\Livewire\TwoFactor;

use Livewire\Component;
use App\Models\User;
use App\Models\Auditoria;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Mail\Notify;


class TwoFactorAuth extends Component
{
    public $number1 = '';
    public $number2 = '';
    public $number3 = '';
    public $number4 = '';
    public $codeValidationStatus = null;
    public $user = null;
    public $correo ='';
    public $mensaje ='';


    protected $rules = [
        'number1' => 'required|numeric',
        'number2' => 'required|numeric',
        'number3' => 'required|numeric',
        'number4' => 'required|numeric',
    ];

    protected $listeners = ['setStatusMessage' => 'setStatusMessage'];



    public function mount($user = null)
    {          
        try {
            if (!$user) {
                return redirect()->to('/login');
            } else {
                $decryptedUser = Crypt::decrypt($user);
                $this->user = $decryptedUser;
                $this->correo = $this->user->email;
            }
        } catch (DecryptException $e) {
            return redirect()->to('/login');
        }
       
    }
    public function render()
    {
        return view('livewire.two-factor.two-factor-auth');
    }

    public function validateCode()
    {
        $this->validate();
        $pin =$this->number1.$this->number2.$this->number3.$this->number4;
        $usuario = User::where('email', $this->user->email)->get()->first();

        $fechaActual = Carbon::parse(date('Y-m-d H:i:s'));  

        $intervalo = $fechaActual->diffInHours(Carbon::parse($usuario->two_factor_date));

        if ($intervalo >= 1) {
            $this->codeValidationStatus = 'danger';
            $this->mensaje = 'Codigo Expirado';
            $this->emit('closeAlertAfterDelay');

      
          } else {
            if($pin == $usuario->two_factor){        
              
                $usuario->two_factor = null;
                $usuario->two_factor_date = null;
                $usuario->save();
                
                $auditoria = Auditoria::create([
                    'usuario' => $usuario->first_name,
                    'correo' => $usuario->email,
                    'observaciones' => "Usuario $usuario->id loggeado en la plataforma",
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],
                ]);
                $randomString = Str::random(3);
                $randomString = strtoupper($randomString); 
                session(['avatar' => $randomString]);

                auth()->login($usuario);
               
                
                return redirect()->intended('/dashboard');
            }else{
                $this->codeValidationStatus = 'danger';
                $this->mensaje = 'Codigo Erroneo';
                $this->emit('closeAlertAfterDelay');

        
            }
      
       }
   }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);

        // Actualiza la propiedad de validez correspondiente
    }
    public function setStatusMessage(){
        $this->codeValidationStatus = null;

    }
    private function  generarCodigo() {
        return str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        }

    public function resend(){

        $codigo = $this->generarCodigo();
            $usuario = User::where('email', $this->user->email)->update([
                'two_factor' => $codigo,
                'two_factor_date' => date('Y-m-d H:i:s'),
              ]);   

              $detalleCorreo = [
                'email' => $this->user->email,
                'pin' => $codigo,
                'Subject' => 'Confirma tu codigo de verificacion CLUSTER-BGA',  
                'tipo'=>'T'      
            ];
              Mail::to($this->user->email)->send(new Notify($detalleCorreo));
              $this->emit('resendSuccess'); // Emitir evento de éxito

              $this->codeValidationStatus = 'success';
            $this->mensaje = 'Codigo Reenviado';
            $this->emit('closeAlertAfterDelay');

    }
}
