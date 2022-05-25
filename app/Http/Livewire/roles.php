<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class roles extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $NombreRol;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.roles.view', [
            'roles' => Role::latest('id')
						->orWhere('name', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
        
    }
	
    private function resetInput()
    {	$this->selected_id=null;
		$this->NombreRol = null;
		
    }

    public function store()
    {
        $this->validate([
            'NombreRol' => 'required',
            ]);
    
            Role::create([ 
                'name' => $this-> NombreRol
            ]);
            
            $this->resetInput();
            session()->flash('message', 'Rol creado correctamente.');
    }

    public function edit($id)
    {
        $record = Role::findOrFail($id);

        $this->selected_id = $id; 
		$this->NombreRol = $record->name;
	
    }

    public function update()
    {
        $this->validate([
            'NombreRol' => 'required']);
    
            if ($this->selected_id) {
                $record = Role::find($this->selected_id);
                $record->update([ 
                'name' => $this-> NombreRol
                ]);
    
                $this->resetInput();
                session()->flash('message', 'Rol actualizado correctamente.');
            }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Role::where('id', $id);
            $record->delete();
        }
    }
}
