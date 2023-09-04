<?php

namespace App\Http\Livewire\Procesos;

use Livewire\Component;
use App\Models\Proceso;
use Illuminate\Validation\Rule;
use App\Models\Auditoria;

class Procesos extends Component
{   
    protected $listeners = [
        'editPermission',
        'limpiarCampos',
        'eliminar',
        'showRoles', 
        'refreshParent' => '$refresh',
        
    ];
    
    public Proceso $procesos;
    public $proceso;    
    public $titulo = 'Crear Proceso';
    public $btnButton = 'Crear';
    public $idProceso='';
    
    protected $messages = [
        'rol.unique' => 'Este Rol ya se encuentra registrado'
    ];
    
    
    protected function rules()
    {
        return [
            'proceso' => ['required', 'max:25', Rule::unique('procesos', 'name')->ignore($this->idProceso)->whereNull('deleted_at'), 'regex:/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ ]{3,25}$/'],
             ];
    }
    public function render()
    {
        return view('livewire.procesos.procesos');
    }
    
    public function limpiarCampos(){
        $this->titulo = 'Crear Proceso';
        $this->btnButton = 'Crear';
        $this->rol = '';
        $this->reset('proceso');
        $this->reset('idProceso');
        $this->resetErrorBag();
        $this->resetValidation();
        
    }



  
    public function mount(Proceso $proceso){
      
        $this->procesos = $proceso;          
     
    }

   
    public function updated($campo)
    {
        $this->validateOnly($campo);
    }

    public function guardar(){
        
        $this->validate();
        if($this->idProceso){
            $proceso = Proceso::findOrFail($this->idProceso);
            $proceso->name = $this->proceso;
            $proceso->save();
                       
            $auditoria = Auditoria::create([
                'usuario' => auth()->user()->first_name,
                'correo' => auth()->user()->email,
                'observaciones'=> 'Actualizacion de Proceso '. $this->proceso .' en la plataforma',
                'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           
    
            ]);

            
            $this->reset('proceso');
            $this->resetErrorBag();
            $this->resetValidation();           
            $this->emitTo('permisos-table', 'updateTable');
            $this->emit('toast', ['title' => 'Proceso exitoso!', 'text' => 'Proceso Actualizado','icon'=>'success']);

        }else{
        
        $proceso = new Proceso();
        $proceso->name = $this->proceso;
        $proceso->save();
       
        $auditoria = Auditoria::create([
                        'usuario' => auth()->user()->first_name,
                        'correo' => auth()->user()->email,
                        'observaciones'=> 'Creacion de Proceso '. $this->proceso .' en la plataforma',
                        'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           
            
                    ]);
        
     
        $this->reset('proceso');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->emitTo('permisos-table', 'updateTable');
        $this->emit('toast', ['title' => 'Proceso exitoso!', 'text' => 'Proceso Creado','icon'=>'success']);
        }         
      
      
        
    }
    public function editPermission(Proceso $proceso){
        $this->titulo = 'Editar Proceso';
        $this->btnButton = 'Editar';
        $this->proceso = $proceso->name;
        $this->idProceso = $proceso->id;         
        $this->dispatchBrowserEvent('edit-modal', ['idModal' => 'modalSignIn']);
        
    }
    

    public function eliminar(Proceso $proceso) {
    
        $auditoria = Auditoria::create([
            'usuario' => auth()->user()->first_name,
            'correo' => auth()->user()->email,
            'observaciones'=> 'Eliminación de proceso '. $proceso->name .' en la plataforma',
            'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           

        ]);

            $proceso->delete();
            $this->emitTo('permisos-table', 'updateTable');
            $this->emit('toast', ['title' => 'Proceso exitoso!', 'text' => 'Area Eliminada','icon'=>'success']);
           
    }
   
}
