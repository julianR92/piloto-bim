<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Spatie\Permission\Models\Permission;

class PermisosTable extends DataTableComponent
{
    protected $model = Permission::class;
    
    
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
            Column::make("Nombre", "name")                
                ->searchable(),
                Column::make('Acciones')
                ->label(
                    fn($row)=> view('livewire.permisos-actions',compact('row'))
                ),
        ];
    }

    public function updateTable(){
        
    }

   

}
