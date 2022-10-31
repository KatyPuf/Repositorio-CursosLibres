<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\CursosEjecutado;
use App\Models\Curso;
use App\Models\AnyosLectivo;
use App\Models\Modalidade;
use App\Models\Trimestre;

class CursosEjecutados extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $keyWordModalidad, $keyWordAnyo, $keyWordFecha ,$Trimestre, $Anyo, $modalidad, $FechaInicio, $FechaFin, $HorarioInicio, 
           $HorarioFin, $curso_id;
    
           public $visible =  true;
    public $updateMode = false;
    protected $listeners = ['destroy'];

    public $selectedNombre = '';
    public $selectedModalidad = '';
    public $selectedAnyo = '';
    public $selectedFecha = '';


    public function render()
    {
        error_log("RENDER RENDER");
		$keyWord = '%'.$this->selectedNombre .'%';
		$keyWordModalidad = '%'.$this->selectedModalidad .'%';
		$keyWordAnyo = '%'.$this->selectedAnyo .'%';
		$keyWordFecha = '%'.$this->selectedFecha .'%';
        $keyVisible = '%'.$this->visible .'%';

        $modalidades = Modalidade::all();
        $anyos = AnyosLectivo::all();
        $cursos = Curso::all();
        $trimestres = Trimestre::all();

        return view('livewire.cursos-ejecutados.view', [
            'cursosEjecutados' => Curso::join('cursos_ejecutados', 'cursos_ejecutados.curso_id', "=", "cursos.id")
                                  ->where('cursos.id', 'LIKE', $keyWord)
                                  ->where('modalidad', 'LIKE', $keyWordModalidad)
                                  ->where('Anyo' ,'Like', $keyWordAnyo)
                                  ->where('cursos_ejecutados.created_at', 'LIKE', $keyWordFecha)
                                  ->where('visible', 'LIKE', $keyVisible)
                                  ->paginate(10),
        ],compact('cursos', 'modalidades', 'anyos', 'trimestres'));
    }
	
    protected $rules = [
        'Trimestre'=> 'required',
        'Anyo'=> 'required',
        'modalidad'=> 'required',
        'FechaInicio'=> 'required',
        'FechaFin'=> 'required',
        'HorarioInicio'=> 'required',
        'HorarioFin'=> 'required',
        'curso_id' => 'required'


    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {	
        $this->resetErrorBag();
        $this->resetValidation();	
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
        date_default_timezone_set("America/Managua");
        setlocale(LC_TIME, 'es_VE.UTF-8','esp');

        $this->validate([
		'Trimestre' => 'required',
		'Anyo' => 'required',
        'modalidad' => 'required',
		'FechaInicio' => 'required',
		'FechaFin' => 'required',
		'HorarioInicio' => 'required',
        'HorarioFin' => 'required',
		'curso_id' => 'required',
        ],[
            'Trimestre.required' => 'Debes seleccionar un trimestre',
            'Anyo.required' => 'Debes seleccionar un año lectivo',
            'curso_id.required' => 'Debes seleccionar un curso',
            'modalidad.required' => 'Debes seleccionar una modalidad',

        ]);

        CursosEjecutado::create([ 
			'Trimestre' => $this-> Trimestre,
			'Anyo' => $this-> Anyo,
            'modalidad' => $this-> modalidad,
			'FechaInicio' => $this-> FechaInicio,
			'FechaFin' => $this-> FechaFin,
			'HorarioInicio' => $this-> HorarioInicio,
            'HorarioFin' => $this-> HorarioFin,
			'curso_id' => $this-> curso_id,
            'created_at' => date('Y-m-d H:i:s')
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
        ],[
            'Trimestre.required' => 'Debes seleccionar un trimestre',
            'Anyo.required' => 'Debes seleccionar un año lectivo',
            'curso_id.required' => 'Debes seleccionar un curso',
            'modalidad.required' => 'Debes seleccionar una modalidad',

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

    public function changeEvent($value)
    {
        
        if($value == 1)
        {
            $this->visible='';
        }else{
            $this->visible=true;
        }
    }

    public function cambiarVisibilidad($id, $visible)
    {
        error_log($id);
        $record = CursosEjecutado::where('id', $id);
        $record->update([ 
			'visible' => $visible]);
        
    }
}
