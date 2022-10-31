<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\AulaCursoProfesor;
use App\Models\Profesore;
use App\Models\CursosEjecutado;
use App\Models\Aula;

class AulaCursoProfesors extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWordAula, $keyWordCurso, $keyWordProfesor,  $profesor_id, $curso_ejecutado_id, $aula_id;
    public $updateMode = false;
    protected $listeners = ['destroy'];
    public $selectedCurso = '';
    public $selectedProfesor = '';
    public $selectedAula = '';

    public function render()
    {
        error_log($this->selectedCurso);
        error_log($this->selectedProfesor);
        error_log($this->selectedAula);


        $cursos = CursosEjecutado::all();
        $profesores = Profesore::all();
        $aulas = Aula::all();
		$keyWordAula = '%'.$this->selectedAula .'%';
		$keyWordCurso = '%'.$this->selectedCurso .'%';
		$keyWordProfesor = '%'.$this->selectedProfesor .'%';
        error_log($keyWordCurso);
       
        return view('livewire.aula-curso-profesors.view', [
            'aulaCursoProfesors' => AulaCursoProfesor::join('cursos_ejecutados', 'cursos_ejecutados.id', '=', 'aula_curso_profesor.curso_ejecutado_id')
                                    ->join('aulas', 'aulas.id', '=', 'aula_curso_profesor.aula_id')
                                    ->join('profesores', 'profesores.id', '=', 'aula_curso_profesor.profesor_id')
                                    ->join('cursos', 'cursos.id', '=','cursos_ejecutados.curso_id')
						            ->where('aula_curso_profesor.profesor_id', 'LIKE', $keyWordProfesor)
						            ->where('aula_curso_profesor.aula_id', 'LIKE', $keyWordAula)
						            ->where('aula_curso_profesor.curso_ejecutado_id', 'LIKE', $keyWordCurso)
                                    ->select('aula_curso_profesor.id', 'aulas.id as aulaId', 'aulas.Nombre',
                                            'profesores.id as profesorId', 'profesores.Nombres', 'profesores.Apellidos',
                                            'cursos.id as cursoId', 'cursos.Nombre as NombreCurso' ,'cursos_ejecutados.modalidad', 
                                            )
						            ->paginate(10),
        ], compact('cursos','profesores', 'aulas'));
    }
	

    protected $rules = [
        'profesor_id'=> 'required',
        'curso_ejecutado_id'=> 'required',
        'aula_id'=> 'required',


    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
	
    public function cancel()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->profesor_id = null;
		$this->curso_ejecutado_id = null;
		$this->aula_id = null;
    }

    public function store()
    {
        $this->validate([
		'profesor_id' => 'required',
		'curso_ejecutado_id' => 'required',
		'aula_id' => 'required',
        ],[
            'profesor_id.required' => 'El campo profesor es requerido',
            'curso_ejecutado_id.required' => 'El campo Curso Aperturado es requerido',
            'aula_id.required' => 'El campo aula es requerido',

        ]);

        AulaCursoProfesor::create([ 
			'profesor_id' => $this-> profesor_id,
			'curso_ejecutado_id' => $this-> curso_ejecutado_id,
			'aula_id' => $this-> aula_id
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Registro creado correctamente.');
    }

    public function edit($id)
    {
        $record = AulaCursoProfesor::findOrFail($id);

        $this->selected_id = $id; 
		$this->profesor_id = $record-> profesor_id;
		$this->curso_ejecutado_id = $record-> curso_ejecutado_id;
		$this->aula_id = $record-> aula_id;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'profesor_id' => 'required',
		'curso_ejecutado_id' => 'required',
		'aula_id' => 'required',
        ],[
            'profesor_id.required' => 'El campo profesor es requerido',
            'curso_ejecutado_id.required' => 'El campo Curso Aperturado es requerido',
            'aula_id.required' => 'El campo aula es requerido',

        ]);

        if ($this->selected_id) {
			$record = AulaCursoProfesor::find($this->selected_id);
            $record->update([ 
			'profesor_id' => $this-> profesor_id,
			'curso_ejecutado_id' => $this-> curso_ejecutado_id,
			'aula_id' => $this-> aula_id
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Registro actualizado correctamente.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = AulaCursoProfesor::where('id', $id);
            $record->delete();
        }
    }

    public function emitirEvento($id)
    {
        $this->emit('deleteRegistro', $id);

    }
}
