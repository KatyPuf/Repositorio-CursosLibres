<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Modalidade;

class Modalidades extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $TipoModalidad;
    public $updateMode = false;
    protected $listeners = ['destroy'];

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.modalidades.view', [
            'modalidades' => Modalidade::latest('id')
						->orWhere('TipoModalidad', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
    protected $rules = [
        'TipoModalidad'=> 'required',
       
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
		$this->TipoModalidad = null;
    }

    public function store()
    {
        $this->validate([
		'TipoModalidad' => 'required',
        ]);

        Modalidade::create([ 
			'TipoModalidad' => $this-> TipoModalidad
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Modalidad creada correctamente.');
    }

    public function edit($id)
    {
        $record = Modalidade::findOrFail($id);

        $this->selected_id = $id; 
		$this->TipoModalidad = $record-> TipoModalidad;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'TipoModalidad' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Modalidade::find($this->selected_id);
            $record->update([ 
			'TipoModalidad' => $this-> TipoModalidad
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Modalidad actualizada correctamente.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Modalidade::where('id', $id);
            $record->delete();
        }
    }
    public function emitirEvento($id)
    {
        $this->emit('deleteRegistro', $id);

    }

}
