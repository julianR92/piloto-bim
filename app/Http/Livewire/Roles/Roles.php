<?php

namespace App\Http\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Permission as Permisos;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;
use App\Models\Auditoria;

class Roles extends Component
{
     
    protected $listeners = [
        'editPermission',
        'limpiarCampos',
        'eliminar',
        'showRoles', 
        'refreshParent' => '$refresh',
        
    ];

    public Role $roles;
    public $permisos =[];
    public $rol;
    public $titulo = 'Crear Roles';
    public $btnButton = 'Crear';
    public $idRol='';

    protected $messages = [
        'rol.unique' => 'Este Rol ya se encuentra registrado'
    ];


    protected function rules()
    {
        return [
            'rol' => ['required', 'max:25', Rule::unique('roles', 'name')->ignore($this->idRol), 'regex:/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ_-]{3,25}$/'],
            'permisos'=>['array'],
            
            
        ];
    }

    public function limpiarCampos(){
        $this->titulo = 'Crear Roles';
        $this->btnButton = 'Crear';
        $this->rol = '';
        $this->reset('permisos');
        $this->reset('idRol');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('cleanData');
    }



    public function render()
    {
        $permissions = Permisos::get();
        return view('livewire.roles.roles',compact('permissions'));
    }
    public function mount(Role $roles){
      
        $this->roles = $roles;          
     
    }

   
    public function updated($campo)
    {
        $this->validateOnly($campo);
    }

    public function guardar(){
        
        $this->validate();
        if($this->idRol){
            $role = Role::findOrFail($this->idRol);
            $data = [
                'name'=>$this->rol,
            ];
            $role->update($data);
            if(!empty($this->permisos)){
            $role->permissions()->sync($this->permisos);
            }
            $auditoria = Auditoria::create([
                'usuario' => auth()->user()->first_name,
                'correo' => auth()->user()->email,
                'observaciones'=> 'Actualizacion de rol '. $this->rol .' en la plataforma',
                'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           
    
            ]);

            $this->dispatchBrowserEvent('cleanData');
            $this->reset('permisos');
            $this->reset('rol');
            $this->resetErrorBag();
            $this->resetValidation();
            $this->emitTo('permisos-table', 'updateTable');
            $this->emit('toast', ['title' => 'Proceso exitoso!', 'text' => 'Rol Actualizado','icon'=>'success']);

        }else{
        $data = [
            'name'=>$this->rol,
        ];
        $role = Role::create($data);
        if (!empty($this->permisos)){
        $role->permissions()->sync($this->permisos);
        }
        $auditoria = Auditoria::create([
                        'usuario' => auth()->user()->first_name,
                        'correo' => auth()->user()->email,
                        'observaciones'=> 'Creacion de rol '. $this->rol .' en la plataforma',
                        'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           
            
                    ]);
        
        $this->dispatchBrowserEvent('cleanData');
        $this->reset('permisos');
        $this->reset('rol');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->emitTo('permisos-table', 'updateTable');
        $this->emit('toast', ['title' => 'Proceso exitoso!', 'text' => 'Rol Creado','icon'=>'success']);
        }         
      
      
        
    }
    public function editPermission(Role $rol){
        $this->titulo = 'Editar Rol';
        $this->btnButton = 'Editar';
        $this->rol = $rol->name;
        $this->idRol = $rol->id;
        $permission_role =[];
        foreach (Role::findById($rol->id)->permissions as $permisos){ // todos los permisos por 1 solo rol
            $permission_role[] = $permisos->id;
         } 
         $this->dispatchBrowserEvent('setDataSelected',['permission' => $permission_role]);    
        $this->dispatchBrowserEvent('edit-modal', ['idModal' => 'modalSignIn']);
        
    }
    

    public function eliminar(Role $rol) {
    
        $auditoria = Auditoria::create([
            'usuario' => auth()->user()->first_name,
            'correo' => auth()->user()->email,
            'observaciones'=> 'Eliminación de rol '. $rol->name .' en la plataforma',
            'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           

        ]);

            $rol->delete();
            $this->emitTo('permisos-table', 'updateTable');
            $this->emit('toast', ['title' => 'Proceso exitoso!', 'text' => 'Rol Eliminado','icon'=>'success']);
           
    }

    public function showRoles(Role $role){
        $roles_permisos = Role::findById($role->id)->permissions()->pluck('name'); 
        $this->dispatchBrowserEvent('dataPermissions',['permission' => $roles_permisos, 'idModal'=>'modalPermisos']);    
        

    }

    

}

   

