<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use App\Models\Auditoria;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\Notify;
use Carbon\Carbon;



class Login extends Component
{

    public $email = '';
    public $password = '';
    public $remember_me = false;
    public $estado = '';

    protected $rules = [
        'email' => 'required|email:rfc,dns',
        'password' => 'required|min:6',
    ];

    //This mounts the default credentials for the admin. Remove this section if you want to make it public.
    public function mount()
    {
        if (auth()->user()) {
            return redirect()->intended('/dashboard');
        }
        // $this->fill([
        //     'email' => 'admin@volt.com',
        //     'password' => 'secret',
        // ]);
    }

    public function login()
    {

        $credentials = $this->validate();
        $user2 = User::where(['email' => $this->email])->first();
        if (!$user2) {
            $this->emit('hideLoad');
            return $this->addError('email', trans('auth.failed'));
        }

        if ($user2->estado !== 'ACTIVO') {
            $this->emit('hideLoad');
            return $this->addError('email', 'Usuario Inactivo');
        } else {
            // Verificar el session_token
            $sessionTokenInDatabase = $user2->session_id;
            $sessionTokenInSession = session('session_token');

            if ($sessionTokenInDatabase !== $sessionTokenInSession) {
                $this->emit('hideLoad');
                return $this->addError('email', 'Sesión no válida. Ya tienes una sesion abierta.');
            }
            if ($credentials['email'] === $user2->email &&  Hash::check($credentials['password'], $user2->password)) {
                $codigo = $this->generarCodigo();
                $usuario = User::where('email', $user2->email)->update([
                    'two_factor' => $codigo,
                    'two_factor_date' => date('Y-m-d H:i:s'),
                ]);

                $detalleCorreo = [
                    'email' => $user2->email,
                    'pin' => $codigo,
                    'Subject' => 'Confirma tu codigo de verrificacion CLUSTER-BGA',
                    'tipo' => 'T'
                ];
                Mail::to($user2->email)->send(new Notify($detalleCorreo));
                $this->emit('hideLoad');

                return redirect()->route('two-factor', ['user' => Crypt::encrypt($user2)]);

                //(auth()->attempt(['email' => $this->email, 'password' => $this->password], $this->estado)
                // auth()->login($user, $this->remember_me);
                // return redirect()->intended('/dashboard');
            } else {
                $this->emit('hideLoad');
                return $this->addError('email', trans('auth.failed'));
            }
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }

    private function  generarCodigo()
    {
        return str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
    }
}
