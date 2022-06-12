<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class roles extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $NombreRol, $permisos, $registros, $permisosAll, $IdPermiso, $IdRol;
    public $updateMode = false;
    protected $listeners = ['destroy','QuitarPermiso'];
   
    public function render()
    {
		$permisosall = Permission::all();
        $keyWord = '%'.$this->keyWord .'%';
      
        return view('livewire.roles.view', [
            'roles' => Role::latest('id')
						->orWhere('name', 'LIKE', $keyWord)
						->paginate(10),
        ], compact('permisosall'));
        error_log("Renderizadooo");
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
   
            $this->NombreRol=ucwords($this-> NombreRol);
            if(!$this->isRoleExist($this->NombreRol))
            {
                Role::create([ 
                    'name' => $this-> NombreRol
                ]);
                
                $this->resetInput();
                session()->flash('message', 'Rol creado correctamente.');
            }
            else
            {
                session()->flash('message2', 'Este rol ya existe.');

            }
           
    }

    function isRoleExist($role_name){
        return Count(Role::findByName($role_name)->get()) > 0;
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
            $this->limpiar();
        }
    }

    public function PermisoPorRol($id)
    {
        $record = Role::findOrFail($id);
        $this->registros = $record->name;
        $this->IdRol = $record->id;
        $this->permisos = $record->getAllPermissions();
       
        
    }

    private function resetInputPermiso()
    {	

		$this->IdPermiso = null;
        

    }
    public function AgregarPermiso()
    {
        if($this->IdRol == null)
        {
            error_log("Comprobando comprobando");
            $this->emit('alertNoAsignadoPermiso', 1);

        }
       $this->validate([
            'IdRol' => 'required',
            'IdPermiso' => 'required'
        ]);

        $record = Role::findOrFail($this->IdRol);
        $permisos=Permission::findOrFail($this->IdPermiso);

        if($record->hasPermissionTo($permisos->name))
        {
            $this->resetInputPermiso();
            $this->emit('NoAsignado', $record->id);
            
        }else{
            $record->givePermissionTo($permisos->name);
             $this->permisos = $record->getAllPermissions();

            $this->resetInputPermiso();
            session()->flash('message', 'Permiso asignado correctamente.');

        }
        
    }

     public function emitirEvento($id)
    {
        $this->emit('deleteRegistro', $id);

    }

    public function emitirEventoQuitarPermiso($id)
    {
        $this->emit('QuitarPermisoEvent', $id);

    }

    public function QuitarPermiso($id)
    {
        $rol= Role::findOrFail($this->IdRol);
        $permiso=Permission::findOrFail($id);
        $rol->revokePermissionTo($permiso->name);
        $this->permisos = $rol->getAllPermissions();
        $this->resetInputPermiso();
    }

    public function limpiar()
    {
        $this->permisos = null;
        $this->IdRol = null;
        $this->IdPermiso = null;
        $this->registros = null;
    }
}
