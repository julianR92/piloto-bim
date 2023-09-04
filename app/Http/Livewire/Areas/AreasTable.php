<?php

namespace App\Http\Livewire\Areas;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Area;

class AreasTable extends DataTableComponent
{
    protected $model = Area::class;

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
                ->sortable()
                ->searchable(),
                Column::make('Acciones')
                ->label(
                    fn($row)=> view('livewire.areas.areas-actions',compact('row'))
                ),
            // Column::make("Updated at", "updated_at")
            //     ->sortable(),
        ];
    }
}
