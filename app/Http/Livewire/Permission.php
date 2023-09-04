<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission as Permisos;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;
use App\Models\Auditoria;

class Permission extends Component
{

    protected $listeners = [
        'editPermission',
        'limpiarCampos',
        'eliminar'
        
    ];

    public Permisos $permisos;
    public $permiso="";
    public $titulo = 'Crear Permisos';
    public $btnButton = 'Crear';
    public $idPermiso='';

    protected $messages = [
        'permiso.unique' => 'Este permiso ya se encuentra registrado'
    ];


    protected function rules()
    {
        return [
            'permiso' => ['required', 'max:25', Rule::unique('permissions', 'name')->ignore($this->idPermiso), 'regex:/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ_-]{3,25}$/'],
            
            
        ];
    }

    public function limpiarCampos(){
        $this->titulo = 'Crear Permisos';
        $this->btnButton = 'Crear';
        $this->permiso = '';
        $this->reset('idPermiso');
    }



    public function render()
    {   
        $permisos = Permisos::all();
        return view('livewire.permission',['permissions' =>$permisos]);
    }

    public function mount(Permisos $permisos){
      
        $this->permisos = $permisos;
     
    }

    public function updated($campo)
    {
        $this->validateOnly($campo);
    }

    public function guardar(){
         
        $this->validate();
        if($this->idPermiso){
        $permisos = Permisos::findOrFail($this->idPermiso);
        $permisos->name = $this->permiso;
         if($permisos->save()){
                
            $auditoria = Auditoria::create([
                'usuario' => auth()->user()->first_name,
                'correo' => auth()->user()->email,
                'observaciones'=> 'Actualizacion de permiso '. $permisos->name .' en la plataforma',
                'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           
    
            ]);

                $this->reset('permiso');
                $this->emitTo('permisos-table', 'updateTable');
                $this->emit('toast', ['title' => 'Proceso exitoso!', 'text' => 'Permiso Actualizado','icon'=>'success']);
         }
        }else{
           
            $permisos = Permisos::create(['name' => $this->permiso]);
            if($permisos){

                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones'=> 'Creacion de permiso '. $this->permiso .' en la plataforma',
                    'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           
        
                ]);
                
                $this->reset('permiso');
                $this->emitTo('permisos-table', 'updateTable');
                $this->emit('toast', ['title' => 'Proceso exitoso!', 'text' => 'Permiso Creado','icon'=>'success']);
            }
           
        }
      
        
    }
    public function editPermission(Permisos $permiso){
        $this->titulo = 'Editar Permisos';
        $this->btnButton = 'Editar';
        $this->permiso = $permiso->name; 
        $this->idPermiso = $permiso->id;       
        $this->dispatchBrowserEvent('edit-modal', ['idModal' => 'modalSignIn']);
        
    }

    public function eliminar(Permisos $permiso) {
    
        $auditoria = Auditoria::create([
            'usuario' => auth()->user()->first_name,
            'correo' => auth()->user()->email,
            'observaciones'=> 'Eliminación de permiso '. $permiso->name .' en la plataforma',
            'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           

        ]);

            $permiso->delete();
            $this->emitTo('permisos-table', 'updateTable');
            $this->emit('toast', ['title' => 'Proceso exitoso!', 'text' => 'Permiso Eliminado','icon'=>'success']);
           
    }

    

}
