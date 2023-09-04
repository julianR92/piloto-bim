<?php

namespace App\Http\Livewire\Roles;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RoleTable extends DataTableComponent
{
    protected $model = Role::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');       
        $this->setDefaultSort('id', 'asc');
        // $this->setRefreshVisible();
        $this->setRefreshTime(5000);
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Rol", "name")
                ->sortable()
                ->searchable(),
                Column::make('Acciones')
                ->label(
                    fn($row)=> view('livewire.roles.roles-actions',compact('row'))
                ),
                
         
        ];
    }
}
