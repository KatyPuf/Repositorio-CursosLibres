<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

class permisos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $NombrePermiso;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.permisos.view', [
            'permisos' => Permission::latest('id')
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
		$this->NombrePermiso = null;
		
    }

    public function store()
    {
        $this->validate([
            'NombrePermiso' => 'required',
            ]);
    
            Permission::create([ 
                'name' => $this-> NombrePermiso
            ]);
            
            $this->resetInput();
            session()->flash('message', 'Permiso creado correctamente.');
    }

    public function edit($id)
    {
        $record = Permission::findOrFail($id);

        $this->selected_id = $id; 
		$this->NombrePermiso = $record->name;
	
    }

    public function update()
    {
        $this->validate([
            'NombrePermiso' => 'required']);
    
            if ($this->selected_id) {
                $record = Permission::find($this->selected_id);
                $record->update([ 
                'name' => $this-> NombrePermiso
                ]);
    
                $this->resetInput();
                session()->flash('message', 'Permiso actualizado correctamente.');
            }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Permission::where('id', $id);
            $record->delete();
        }
    }
}
