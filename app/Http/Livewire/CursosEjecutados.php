<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\CursosEjecutado;
use App\Models\Curso;
use App\Models\AnyosLectivo;
use App\Models\Modalidade;

class CursosEjecutados extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $keyWordModalidad, $keyWordAnyo, $Trimestre, $Anyo, $modalidad, $FechaInicio, $FechaFin, $HorarioInicio, 
           $HorarioFin, $curso_id;
    public $updateMode = false;
    protected $listeners = ['destroy'];

    public $selectedNombre = '';
    public $selectedModalidad = '';
    public $selectedAnyo = '';

    public function render()
    {
		$keyWord = '%'.$this->selectedNombre .'%';
		$keyWordModalidad = '%'.$this->selectedModalidad .'%';
		$keyWordAnyo = '%'.$this->selectedAnyo .'%';
        $modalidades = Modalidade::all();
        $anyos = AnyosLectivo::all();
        $cursos = Curso::all();

        return view('livewire.cursos-ejecutados.view', [
            'cursosEjecutados' => CursosEjecutado::join('cursos', 'cursos_ejecutados.curso_id', "=", "cursos.id")
                                  ->where('cursos.id', 'LIKE', $keyWord)
                                  ->where('modalidad', 'LIKE', $keyWordModalidad)
                                  ->where('Anyo' ,'Like', $keyWordAnyo)
                                  ->get(['cursos_ejecutados.id','Nombre', 'Trimestre', 'Anyo', 'modalidad',
                                        'FechaInicio', 'FechaFin', 'HorarioInicio', 'HorarioFin', 'cursos_ejecutados.created_at'
                                    ])
        ],compact('cursos', 'modalidades', 'anyos'));
    }
	
    /*latest('id')
						->orWhere('Trimestre', 'LIKE', $keyWord)
						->orWhere('Anyo', 'LIKE', $keyWord)
                        ->orWhere('modalidad', 'LIKE', $keyWord)
						->orWhere('FechaInicio', 'LIKE', $keyWord)
						->orWhere('FechaFin', 'LIKE', $keyWord)
						->orWhere('HorarioInicio', 'LIKE', $keyWord)
                        ->orWhere('HorarioFin', 'LIKE', $keyWord)
						->orWhere('curso_id', 'LIKE', $keyWord) */
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->Trimestre = null;
		$this->Anyo = null;
        $this->modalidad = null;
		$this->FechaInicio = null;
		$this->FechaFin = null;
		$this->HorarioInicio = null;
        $this->HorarioFin = null;
		$this->curso_id = null;
    }

    public function store()
    {
        $this->validate([
		'Trimestre' => 'required',
		'Anyo' => 'required',
        'modalidad' => 'required',
		'FechaInicio' => 'required',
		'FechaFin' => 'required',
		'HorarioInicio' => 'required',
        'HorarioFin' => 'required',
		'curso_id' => 'required',
        ]);

        CursosEjecutado::create([ 
			'Trimestre' => $this-> Trimestre,
			'Anyo' => $this-> Anyo,
            'modalidad' => $this-> modalidad,
			'FechaInicio' => $this-> FechaInicio,
			'FechaFin' => $this-> FechaFin,
			'HorarioInicio' => $this-> HorarioInicio,
            'HorarioFin' => $this-> HorarioFin,
			'curso_id' => $this-> curso_id
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Registro creado correctamente.');
    }

    public function edit($id)
    {
        $record = CursosEjecutado::findOrFail($id);

        $this->selected_id = $id; 
		$this->Trimestre = $record-> Trimestre;
		$this->Anyo = $record-> Anyo;
        $this->modalidad = $record-> modalidad;
		$this->FechaInicio = $record-> FechaInicio;
		$this->FechaFin = $record-> FechaFin;
		$this->HorarioInicio = $record-> HorarioInicio;
        $this->HorarioFin = $record-> HorarioFin;
		$this->curso_id = $record-> curso_id;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'Trimestre' => 'required',
		'Anyo' => 'required',
        'modalidad' => 'required',
		'FechaInicio' => 'required',
		'FechaFin' => 'required',
		'HorarioInicio' => 'required',
        'HorarioFin' => 'required',
		'curso_id' => 'required',
        ]);

        if ($this->selected_id) {
			$record = CursosEjecutado::find($this->selected_id);
            $record->update([ 
			'Trimestre' => $this-> Trimestre,
			'Anyo' => $this-> Anyo,
            'modalidad' => $this-> modalidad,
			'FechaInicio' => $this-> FechaInicio,
			'FechaFin' => $this-> FechaFin,
			'HorarioInicio' => $this-> HorarioInicio,
            'HorarioFin' => $this-> HorarioFin,
			'curso_id' => $this-> curso_id
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Registro actualizado correctamente.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = CursosEjecutado::where('id', $id);
            $record->delete();
        }
    }
    public function emitirEvento($id)
    {
        $this->emit('deleteRegistro', $id);

    }
}
