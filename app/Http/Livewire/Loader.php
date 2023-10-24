<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Loader extends Component
{ 
    public $showLoader = false;

     
    public function render()
    {
        return view('livewire.loader');
    }
}
