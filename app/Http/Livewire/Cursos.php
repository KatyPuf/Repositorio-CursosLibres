<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Curso;
use App\Models\Planificacione;

class Cursos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $Nombre, $Semanas, $Horas, $Precio, $contador;
    public $updateMode = false;
    protected $listeners = ['destroy'];

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.cursos.view', [
            'cursos' => Curso::latest('id')
						->orWhere('Nombre', 'LIKE', $keyWord)
						->orWhere('Semanas', 'LIKE', $keyWord)
						->orWhere('Horas', 'LIKE', $keyWord)
						->orWhere('Precio', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->Nombre = null;
		$this->Semanas = null;
		$this->Horas = null;
		$this->Precio = null;
    }

    public function store()
    {
        $this->validate([
		'Nombre' => 'required',
		'Semanas' => 'required',
		'Horas' => 'required',
		'Precio' => 'required',
        ]);

        Curso::create([ 
			'Nombre' => $this-> Nombre,
			'Semanas' => $this-> Semanas,
			'Horas' => $this-> Horas,
			'Precio' => $this-> Precio
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Curso creado correctamente.');
    }

    public function edit($id)
    {
        $record = Curso::findOrFail($id);

        $this->selected_id = $id; 
		$this->Nombre = $record-> Nombre;
		$this->Semanas = $record-> Semanas;
		$this->Horas = $record-> Horas;
		$this->Precio = $record-> Precio;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'Nombre' => 'required',
		'Semanas' => 'required',
		'Horas' => 'required',
		'Precio' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Curso::find($this->selected_id);
            $record->update([ 
			'Nombre' => $this-> Nombre,
			'Semanas' => $this-> Semanas,
			'Horas' => $this-> Horas,
			'Precio' => $this-> Precio
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Curso actualizado correctamente.');
        }
    }

    public function destroy($id)
    {
       
        if ($id) {
            
            $record = Curso::where('id', $id);
            $record->delete();
        }
    }

    public function emitirEvento($id)
    {
        if($this->verificarSiExistePlanificacion($id) == 0)
        {
            
            $this->emit('deleteRegistro', $id);

            
        }
        else{
            $this->emit('noEliminarRegistro', $id);
        }
    }

    public function verificarSiExistePlanificacion($id)
    {
       $contador = Curso::join('planificaciones','planificaciones.curso_id','=', 'cursos.id')
        ->where('cursos.id', $id)
        ->count();

        return $contador;
    }
}
