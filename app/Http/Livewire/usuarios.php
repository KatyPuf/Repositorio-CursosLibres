<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class usuarios extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $rol, $name, $lastname, $idUser, $usuarioName, $rolesName;
    public $updateMode = false;
    protected $listeners = ['destroy'];

    public function render()
    {
        $roles = Role::all();
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.usuarios.view', [
            'usuarios' => User::latest('id')
						->orWhere('name', 'LIKE', $keyWord)
						->orWhere('lastname', 'LIKE', $keyWord)
						->paginate(10),
        ], compact('roles'));
    }
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {	
        $this->rol = null;	
		$this->name = null;
		$this->lastname = null;
    }

    public function store()
    {
       
    }

    public function edit($id)
    {
        
    }

    public function update()
    {
       
    }

    public function destroy($id)
    {
        if ($id) {
            $record = User::where('id', $id);
            $record->delete();
            $this->limpiar();
        }
    }

    public function limpiar()
    {
        $this->idUser = null;
        $this->rol = null;
        $this->rolesName = null;
        $this->usuarioName = null;
        $this->idUser = null;
    }

    public function resetInputRol()
    {
        
        $this->rol = null;
    }
    public function asignarRol()
    {
         
        $this->validate([
            'idUser' => 'required',
            'rol' => 'required'
        ]);
       
        
        $user = User::findOrFail($this->idUser);
        $rol = Role::findOrFail($this->rol);
      
        if($user->hasRole($rol->name)){
            $this->resetInputRol();
            $this->emit('info', $user->id);

        }else{
            $user->assignRole($rol->name);
            $this->rolesName =$user->getRoleNames();
            $this->resetInputRol();
            session()->flash('message', 'Rol asignado correctamente.');
        }
        
       
    }

    public function RolesUsuario($id)
    {
        $record = User::findOrFail($id);
        $this->usuarioName = $record->name." ".$record->lastname;
        $this->idUser = $record->id;
        $this->rolesName = $record->getRoleNames();
       error_log( $this->rolesName);
        
    }
    
    public function emitirEvento($id)
    {
        $this->emit('deleteRegistro', $id);

    }
}