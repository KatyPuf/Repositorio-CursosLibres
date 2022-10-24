<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Estudiante;
use App\Models\EmpresasTelefonica;
use Illuminate\Support\Facades\Gate;
class Estudiantes extends Component
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
        return view('livewire.estudiantes.view', [
            'estudiantes' => Estudiante::latest('id')
						->orWhere('Cedula', 'LIKE', $keyWord)
						->orWhere('Nombres', 'LIKE', $keyWord)
						->orWhere('Apellidos', 'LIKE', $keyWord)
						->orWhere('Correo', 'LIKE', $keyWord)
						->orWhere('Celular', 'LIKE', $keyWord)
						->orWhere('EmpresaTelefonica', 'LIKE', $keyWord)
						->paginate(10),
          ],compact('telefonias'));
    }
	
    public function cancel()
    {
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
            'Cedula' => 'required|max:16|regex:/^\d{3}-\d{6}-\d{4}[A-Z]$/',
            'Nombres' => 'required|regex:/^[\pL\s\-]+$/u',
            'Apellidos' => 'required|regex:/^[\pL\s\-]+$/u',
            'Correo' => 'required|email',
            'Celular' => 'required|max:8|min:8',
            'EmpresaTelefonica' => 'required',

            
        ],
    [
        'Correo.email' => 'Formato de correo no valido',
        'Celular.max' => 'Maximo 8 digitos',
        'Celular.min' => 'Minimo 8 digitos',
        'Nombres.regex' => 'El nombre no incluye numeros',
        'Apellidos.regex' => 'El apellido no incluye numeros',
        'Cedula.max' => 'Maximo 16 caracteres para cedula',
        'Cedula.regex' => 'Formato de cedula invalido'
    ]);

        //if(Gate::allows('create')){
            Estudiante::create([ 
                'Cedula' => $this-> Cedula,
                'Nombres' => $this-> Nombres,
                'Apellidos' => $this-> Apellidos,
                'Correo' => $this-> Correo,
                'Celular' => $this-> Celular,
                'EmpresaTelefonica' => $this-> EmpresaTelefonica,
                'user_id' => auth()->user()->id
            ]);
            
            $this->resetInput();
            $this->emit('closeModal');
            session()->flash('message', 'Estudiante  creado correctamente.');
        /*}else{
            $this->resetInput();
            $this->emit('closeModal');
            session()->flash('message', 'Acción no permitida');
        }*/

        
    }

    public function edit($id)
    {
        $record = Estudiante::findOrFail($id);

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
		'Cedula' => 'required',
		'Nombres' => 'required',
		'Apellidos' => 'required',
		'Correo' => 'required',
		'Celular' => 'required',
		'EmpresaTelefonica' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Estudiante::find($this->selected_id);
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
			session()->flash('message', 'Estudiante actualizado correctamente.');
        }
    }
    public function destroy($id)
    {
        if ($id) {
            $record = Estudiante::where('id', $id);
            $record->delete();
        }
    }
    public function emitirEvento($id)
    {
        $this->emit('deleteRegistro', $id);

    }
}
