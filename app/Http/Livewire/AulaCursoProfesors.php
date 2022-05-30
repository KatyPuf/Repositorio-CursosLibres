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
    public $selected_id, $keyWord, $profesor_id, $curso_ejecutado_id, $aula_id;
    public $updateMode = false;
    protected $listeners = ['destroy'];
    
    public function render()
    {
        $cursos = CursosEjecutado::all();
        $profesores = Profesore::all();
        $aulas = Aula::all();
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.aula-curso-profesors.view', [
            'aulaCursoProfesors' => AulaCursoProfesor::latest('curso_ejecutado_id')
						->orWhere('profesor_id', 'LIKE', $keyWord)
						->orWhere('curso_ejecutado_id', 'LIKE', $keyWord)
						->orWhere('aula_id', 'LIKE', $keyWord)
						->paginate(10),
        ], compact('cursos','profesores', 'aulas'));
    }
	
    public function cancel()
    {
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
