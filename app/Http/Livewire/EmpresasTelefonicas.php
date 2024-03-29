<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\EmpresasTelefonica;

class EmpresasTelefonicas extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $Nombre;
    public $updateMode = false;
    protected $listeners = ['destroy'];

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.empresas-telefonicas.view', [
            'empresasTelefonicas' => EmpresasTelefonica::latest()
						->orWhere('Nombre', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    protected $rules = [
        'Nombre'=> 'required',
      

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
    }

    public function store()
    {
        $this->validate([
		'Nombre' => 'required',
        ]);

        EmpresasTelefonica::create([ 
			'Nombre' => $this-> Nombre
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Empresa telefonica creada con éxito.');
    }

    public function edit($id)
    {
        $record = EmpresasTelefonica::findOrFail($id);

        $this->selected_id = $id; 
		$this->Nombre = $record-> Nombre;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'Nombre' => 'required',
        ]);

        if ($this->selected_id) {
			$record = EmpresasTelefonica::find($this->selected_id);
            $record->update([ 
			'Nombre' => $this-> Nombre
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Empresa telefonica actualizada con exito.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = EmpresasTelefonica::where('id', $id);
            $record->delete();
        }
    }
    public function emitirEvento($id)
    {
        $this->emit('deleteRegistro', $id);

    }
}
