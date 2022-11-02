<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Profesore;
use App\Models\EmpresasTelefonica;
class Profesores extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $Cedula, $Nombres, $Apellidos, $Correo, $Celular, $EmpresaTelefonica;
    public $updateMode = false;
    protected $listeners = ['destroy'];

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        $telefonias = EmpresasTelefonica::all();
        return view('livewire.profesores.view', [
            'profesores' => Profesore::latest('id') // Ordenar por id de forma ascendente, de forma determinada ordena por la columan create_at, puesto que desactivamos el timestamps, debemos especificar el campo por el cual se va a ordenar
						->orWhere('Cedula', 'LIKE', $keyWord)
						->orWhere('Nombres', 'LIKE', $keyWord)
						->orWhere('Apellidos', 'LIKE', $keyWord)
						->orWhere('Correo', 'LIKE', $keyWord)
						->orWhere('Celular', 'LIKE', $keyWord)
						->orWhere('EmpresaTelefonica', 'LIKE', $keyWord)
						->paginate(10),
        ],compact('telefonias'));
    }
	
    protected $rules = [
        'Cedula'=> 'required|max:16|min:16',
        'Nombres'=> 'required|regex:/^[\pL\s\-]+$/u',
        'Apellidos'=> 'required|regex:/^[\pL\s\-]+$/u',
        'Correo'=> 'required|email',
        'Celular'=> 'required|max:8|min:8',
        'EmpresaTelefonica'=> 'required'



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
		$this->Cedula = null;
		$this->Nombres = null;
		$this->Apellidos = null;
		$this->Correo = null;
		$this->Celular = null;
		$this->EmpresaTelefonica = null;
    }

    public function store()
    {
        $this->validate([
            'Cedula'=> 'required|max:16|min:16',
            'Nombres'=> 'required|regex:/^[\pL\s\-]+$/u',
            'Apellidos'=> 'required|regex:/^[\pL\s\-]+$/u',
            'Correo'=> 'required|email',
            'Celular'=> 'required|max:8|min:8',
            'EmpresaTelefonica'=> 'required'
        ]);

        Profesore::create([ 
			'Cedula' => $this-> Cedula,
			'Nombres' => $this-> Nombres,
			'Apellidos' => $this-> Apellidos,
			'Correo' => $this-> Correo,
			'Celular' => $this-> Celular,
			'EmpresaTelefonica' => $this-> EmpresaTelefonica
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Profesor creado correctamente.');
    }

    public function edit($id)
    {
        $record = Profesore::findOrFail($id);

        $this->selected_id = $id; 
		$this->Cedula = $record-> Cedula;
		$this->Nombres = $record-> Nombres;
		$this->Apellidos = $record-> Apellidos;
		$this->Correo = $record-> Correo;
		$this->Celular = $record-> Celular;
		$this->EmpresaTelefonica = $record-> EmpresaTelefonica;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'Cedula'=> 'required|max:16|min:16',
            'Nombres'=> 'required|regex:/^[\pL\s\-]+$/u',
            'Apellidos'=> 'required|regex:/^[\pL\s\-]+$/u',
            'Correo'=> 'required|email',
            'Celular'=> 'required|max:8|min:8',
            'EmpresaTelefonica'=> 'required'
        ]);

        if ($this->selected_id) {
			$record = Profesore::find($this->selected_id);
            $record->update([ 
			'Cedula' => $this-> Cedula,
			'Nombres' => $this-> Nombres,
			'Apellidos' => $this-> Apellidos,
			'Correo' => $this-> Correo,
			'Celular' => $this-> Celular,
			'EmpresaTelefonica' => $this-> EmpresaTelefonica
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Profesor actualizado correctamente.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Profesore::where('id', $id);
            $record->delete();
        }
    }

    public function emitirEvento($id)
    {
        $this->emit('deleteRegistro', $id);

    }
}
