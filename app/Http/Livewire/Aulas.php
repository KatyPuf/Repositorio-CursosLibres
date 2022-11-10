<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Aula;
use App\Models\Profesore;
use Livewire\WithFileUploads;
use Illuminate\Http\Request;

class Aulas extends Component
{
    use WithPagination;
   
	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $Nombre, $Ubicacion;
    public $updateMode = false;
    public $vista;
    protected $listeners = ['destroy'];
    public $imagen;
    public function render()
    {

	$keyWord = '%'.$this->keyWord .'%';
    return view('livewire.aulas.view', [
                                    'aulas' => Aula::latest('id')
                                    ->orWhere('Nombre', 'LIKE', $keyWord)
                                    ->orWhere('Ubicacion', 'LIKE', $keyWord)
                                    ->paginate(10)
                    ]);

    
    
    }

    protected $rules = [
        'Nombre'=> 'required',
        'Ubicacion'=> 'required',

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
		$this->Nombre = null;
		$this->Ubicacion = null;
    }

    public function store()
    {
        $this->validate([
		'Nombre' => 'required',
		'Ubicacion' => 'required',
        ]);

        Aula::create([ 
			'Nombre' => $this-> Nombre,
			'Ubicacion' => $this-> Ubicacion
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Aula creada correctamente.');
    }

    public function edit($id)
    {
        $record = Aula::findOrFail($id);

        $this->selected_id = $id; 
		$this->Nombre = $record-> Nombre;
		$this->Ubicacion = $record-> Ubicacion;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'Nombre' => 'required',
		'Ubicacion' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Aula::find($this->selected_id);
            $record->update([ 
			'Nombre' => $this-> Nombre,
			'Ubicacion' => $this-> Ubicacion
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Aula actualizada correctamente.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Aula::where('id', $id);
            $record->delete();
        }
    }
    public function emitirEvento($id)
    {
        $this->emit('deleteRegistro', $id);

    }

   
}
