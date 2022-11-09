<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Aula;
use App\Models\Profesore;
use Livewire\WithFileUploads;
use Illuminate\Http\Request;

class Aulas extends Component
{
    use WithPagination;
    use WithFileUploads;
	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $Nombre, $Ubicacion;
    public $updateMode = false;
    public $vista;
    protected $listeners = ['destroy'];
    public $imagen;
    public function render()
    {

	$keyWord = '%'.$this->keyWord .'%';
    return view('livewire.aulas.view', [
                                    'aulas' => Aula::latest('id')
                                    ->orWhere('Nombre', 'LIKE', $keyWord)
                                    ->orWhere('Ubicacion', 'LIKE', $keyWord)
                                    ->paginate(10)
                    ]);

    
    
    }

    protected $rules = [
        'Nombre'=> 'required',
        'Ubicacion'=> 'required',

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
		$this->Ubicacion = null;
    }

    public function store()
    {
        $this->validate([
		'Nombre' => 'required',
		'Ubicacion' => 'required',
        ]);

        Aula::create([ 
			'Nombre' => $this-> Nombre,
			'Ubicacion' => $this-> Ubicacion
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Aula creada correctamente.');
    }

    public function edit($id)
    {
        $record = Aula::findOrFail($id);

        $this->selected_id = $id; 
		$this->Nombre = $record-> Nombre;
		$this->Ubicacion = $record-> Ubicacion;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'Nombre' => 'required',
		'Ubicacion' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Aula::find($this->selected_id);
            $record->update([ 
			'Nombre' => $this-> Nombre,
			'Ubicacion' => $this-> Ubicacion
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Aula actualizada correctamente.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Aula::where('id', $id);
            $record->delete();
        }
    }
    public function emitirEvento($id)
    {
        $this->emit('deleteRegistro', $id);

    }

    public function restore (Request $request)
    {
       //$image = $this->imagen->store('planificacion', 'public');
       // dd($request);
       // $path = $request->input("url");

        $dbHost     =env('DB_HOST');;
        $dbUsername = env('DB_USERNAME');
        $dbPassword = env('DB_PASSWORD');
        $dbName     = env('DB_DATABASE');
        $dbPort     = env('DB_PORT');
        $filePath   = $this->imagen->getRealPath();
  
       
         //restoreDatabaseTables($dbHost, $dbUsername, $dbPassword,$dbPort, $dbName, $filePath);
  
  
      // Connect & select the database
       $db = new \mysqli($dbHost, $dbUsername, $dbPassword, $dbName,$dbPort); 
  
      // Temporary variable, used to store current query
      $templine = '';
      
      // Read in entire file
      $lines = file($filePath);
      
      //$error = '';
      $output = array('error'=>false);
      
      // Loop through each line
      foreach ($lines as $line){
          // Skip it if it's a comment
          if(substr($line, 0, 2) == '--' || $line == ''){
              continue;
          }
          
          // Add this line to the current segment
          $templine .= $line;
          
          // If it has a semicolon at the end, it's the end of the query
          if (substr(trim($line), -1, 1) == ';'){
              // Perform the query
              $query = $db->query($templine);// 
              if(!$query){
                  $output['error'] = true;
                  $output['message'] = $db->error;
              }else{
                //$error_log($query);
                $output['message'] = 'datos restaurados';
                
            }
              // Reset temp variable to empty
              $templine = '';
          }
          
      }
      //return $output;
      dd("restore");
      return redirect()->route('home');
    }
}
