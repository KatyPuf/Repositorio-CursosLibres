<?php

namespace App\Http\Livewire;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Action;

use App\Models\User;
use App\Models\Estudiante;
use App\Models\Inscripcione;
use App\Models\Planificacione;
use App\Models\Curso;

class Inscripciones2 extends LivewireDatatable
{
    public function builder()
    {
      return Estudiante::query()
        ->join('inscripciones', 'inscripciones.estudiante_id', 'estudiantes.id')
        ->join('planificaciones', 'planificaciones.id', 'inscripciones.planificacione_id')
        ->join('cursos', 'cursos.id', 'planificaciones.curso_id');
      //  ->groupBy('users.id');
    }

    public function columns()
    {
        return [
           NumberColumn::name('estudiantes.id')
                ->label('ID')
                ->defaultSort('asc')
                ->sortBy('estudiantes.id'),
                
                Column::name('estudiantes.Nombres')
                ->label('Nombres'),
               
                Column::name('estudiantes.Apellidos')
                ->label('Apellidos'),
                
                Column::name('estudiantes.correo')
                ->label('Correo'),

                Column::name('estudiantes.Celular')
                ->label('Celular'), 

                Column::name('cursos.Nombre')
                ->label('Curso'),
                
                /*Column::callback(['id', 'Nombres'], function ($id, $Nombres) {
                    return view('table-actions', ['id' => $id, 'Nombres' => $Nombres]);
                })->unsortable()*/
               
        ];
    }
   
}
