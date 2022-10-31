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
    protected $listeners = ['destroy'];

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
        $this->resetErrorBag();
        $this->resetValidation();
        $this->resetInput();
        
    }
	
    private function resetInput()
    {	$this->selected_id=null;
		$this->NombrePermiso = null;
		
    }

    
}
