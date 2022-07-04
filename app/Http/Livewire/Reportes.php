<?php

namespace App\Http\Livewire;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;
use App\Models\User;
class Reportes extends LivewireDatatable
{
    public $model = User::class;

    public function columns()
    {
        return [
           NumberColumn::name('id')
                ->label('ID')
                ->defaultSort('asc')
                ->sortBy('id'),

            Column::name('name')
                ->label('Name'),

            Column::name('email')
                ->label('Email'),
        
        ];
    }
  /*  public function render()
    {
        return view('livewire.reportes.view');
    }*/
}
