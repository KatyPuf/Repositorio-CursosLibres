<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Trimestre;

class Trimestres extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $Nombre, $Estado;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.trimestres.view', [
            'trimestres' => Trimestre::latest('id')
						->orWhere('Nombre', 'LIKE', $keyWord)
						->orWhere('Estado', 'LIKE', $keyWord)
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
		$this->Estado = null;
    }

    public function store()
    {
        $this->validate([
		'Nombre' => 'required',
		'Estado' => 'required',
        ]);

        Trimestre::create([ 
			'Nombre' => $this-> Nombre,
			'Estado' => $this-> Estado
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Trimestre creado correctamente.');
    }

    public function edit($id)
    {
        $record = Trimestre::findOrFail($id);

        $this->selected_id = $id; 
		$this->Nombre = $record-> Nombre;
		$this->Estado = $record-> Estado;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'Nombre' => 'required',
		'Estado' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Trimestre::find($this->selected_id);
            $record->update([ 
			'Nombre' => $this-> Nombre,
			'Estado' => $this-> Estado
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Trimestre actualizado correctamente.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Trimestre::where('id', $id);
            $record->delete();
        }
    }
}
