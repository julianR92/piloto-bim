<?php

namespace App\Http\Livewire\Procesos;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Proceso;

class ProcesosTable extends DataTableComponent
{
    protected $model = Proceso::class;

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
        Column::make("Nombre", "name")
            ->sortable()
            ->searchable(),
            Column::make('Acciones')
            ->label(
                fn($row)=> view('livewire.procesos.procesos-actions',compact('row'))
            ),
        ];
    }
}
