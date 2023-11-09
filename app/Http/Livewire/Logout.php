<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Auth;
use App\Models\User;
use Livewire\Component;

class Logout extends Component
{

    public function logout() {
        $user = User::find(auth()->user()->id);
        $user->session_id = null;
        $user->save();
        auth()->logout();
        return redirect('/login');
    }
    public function render()
    {
        return view('livewire.logout');
    }
}
