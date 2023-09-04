<?php

namespace App\Http\Livewire\Users;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;

class UserTable extends DataTableComponent

{
    protected $model = User::class;
    public string $tableName = 'users';

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'asc');
        $this->setRefreshTime(5000);
    }

    public function columns(): array
    { 
        return [
            Column::make("Id", "id")
                ->sortable(),
                Column::make('Nombre','first_name')
                ->sortable(),
                Column::make('Apellidos','last_name')
                ->sortable(),
                Column::make('Usuario','email')
                ->sortable(),
                Column::make('status','estado')                
                ->deselected(),// Hide this header on mobile
                Column::make('Acciones')
                ->label(
                    fn($row)=> view('livewire.users.users-actions',compact('row'))
                ),
                Column::make('Estado')
                ->label(
                    fn($row)=> view('livewire.users.estado-actions',compact('row'))
                ),


                
               
                
                            
            
        ];
    }

    public function builder(): Builder
    {   
        
        $usuario = User::findOrFail(auth()->user()->id);
        if($usuario->getRoleNames()[0] == 'ADMIN'){
            return User::query()->where('role_id','!=' ,1)->where('role_id','!=',2)->leftjoin('roles', 'roles.id', 'users.role_id');   
         } else {
            return User::query()->leftjoin('roles', 'roles.id', 'users.role_id');
         }
    }

    
}
