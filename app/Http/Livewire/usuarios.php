<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Role;
class usuarios extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $rol, $name, $lastname;
    public $updateMode = false;

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
            $record = users::where('id', $id);
            $record->delete();
        }
    }

    public function asignar()
    {
        
       
    }
}