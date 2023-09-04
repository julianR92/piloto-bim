<?php

namespace App\Http\Livewire\Areas;

use Livewire\Component;
use App\Models\Area;
use Illuminate\Validation\Rule;
use App\Models\Auditoria;

class Areas extends Component
{
    
    protected $listeners = [
        'editPermission',
        'limpiarCampos',
        'eliminar',
        'showRoles', 
        'refreshParent' => '$refresh',
        
    ];
    
    public Area $areas;
    public $area;    
    public $titulo = 'Crear Area';
    public $btnButton = 'Crear';
    public $idArea='';
    
    protected $messages = [
        'rol.unique' => 'Este Rol ya se encuentra registrado'
    ];
    
    
    protected function rules()
    {
        return [
            'area' => ['required', 'max:25', Rule::unique('areas', 'name')->ignore($this->idArea)->whereNull('deleted_at'), 'regex:/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ ]{3,25}$/'],
             ];
    }
    public function render()
    {
        return view('livewire.areas.areas');
    }
    
    public function limpiarCampos(){
        $this->titulo = 'Crear Area';
        $this->btnButton = 'Crear';
        $this->rol = '';
        $this->reset('area');
        $this->reset('idArea');
        $this->resetErrorBag();
        $this->resetValidation();
        
    }



  
    public function mount(Area $area){
      
        $this->area = $area;          
     
    }

   
    public function updated($campo)
    {
        $this->validateOnly($campo);
    }

    public function guardar(){
        
        $this->validate();
        if($this->idArea){
            $area = Area::findOrFail($this->idArea);
            $area->name = $this->area;
            $area->save();
                       
            $auditoria = Auditoria::create([
                'usuario' => auth()->user()->first_name,
                'correo' => auth()->user()->email,
                'observaciones'=> 'Actualizacion de Area '. $this->area .' en la plataforma',
                'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           
    
            ]);

            
            $this->reset('area');
            $this->resetErrorBag();
            $this->resetValidation();           
            $this->emitTo('permisos-table', 'updateTable');
            $this->emit('toast', ['title' => 'Proceso exitoso!', 'text' => 'Area Actualizada','icon'=>'success']);

        }else{
        
        $area = new Area();
        $area->name = $this->area;
        $area->save();
       
        $auditoria = Auditoria::create([
                        'usuario' => auth()->user()->first_name,
                        'correo' => auth()->user()->email,
                        'observaciones'=> 'Creacion de area '. $this->area .' en la plataforma',
                        'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           
            
                    ]);
        
     
        $this->reset('area');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->emitTo('permisos-table', 'updateTable');
        $this->emit('toast', ['title' => 'Proceso exitoso!', 'text' => 'Area Creada','icon'=>'success']);
        }         
      
      
        
    }
    public function editPermission(Area $area){
        $this->titulo = 'Editar Area';
        $this->btnButton = 'Editar';
        $this->area = $area->name;
        $this->idArea = $area->id;         
        $this->dispatchBrowserEvent('edit-modal', ['idModal' => 'modalSignIn']);
        
    }
    

    public function eliminar(Area $area) {
    
        $auditoria = Auditoria::create([
            'usuario' => auth()->user()->first_name,
            'correo' => auth()->user()->email,
            'observaciones'=> 'Eliminación de area '. $area->name .' en la plataforma',
            'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           

        ]);

            $area->delete();
            $this->emitTo('permisos-table', 'updateTable');
            $this->emit('toast', ['title' => 'Proceso exitoso!', 'text' => 'Area Eliminada','icon'=>'success']);
           
    }
}
