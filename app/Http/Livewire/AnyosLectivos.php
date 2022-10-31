<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\AnyosLectivo;

class AnyosLectivos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $AnyoLectivo;
    public $updateMode = false;
    protected $listeners = ['destroy'];

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.anyos-lectivos.view', [
            'anyosLectivos' => AnyosLectivo::latest('id')
						->orWhere('AnyoLectivo', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    protected $rules = [
        'AnyoLectivo'=> 'required',
       

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
		$this->AnyoLectivo = null;
    }

    public function store()
    {
        $this->validate([
		'AnyoLectivo' => 'required',
        ],[
            'AnyoLectivo.required' => 'Debes ingresar un año lectivo',
            

        ]);

        AnyosLectivo::create([ 
			'AnyoLectivo' => $this-> AnyoLectivo
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Año lectivo creado correctamente.');
    }

    public function edit($id)
    {
        $record = AnyosLectivo::findOrFail($id);

        $this->selected_id = $id; 
		$this->AnyoLectivo = $record-> AnyoLectivo;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'AnyoLectivo' => 'required',
        ],[
            'AnyoLectivo.required' => 'Debes ingresar un año lectivo',
            

        ]);

        if ($this->selected_id) {
			$record = AnyosLectivo::find($this->selected_id);
            $record->update([ 
			'AnyoLectivo' => $this-> AnyoLectivo
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Año lectivo actualizado correctamente.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = AnyosLectivo::where('id', $id);
            $record->delete();
        }
    }
    public function emitirEvento($id)
    {
        $this->emit('deleteRegistro', $id);

    }
}
