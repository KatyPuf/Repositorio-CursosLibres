<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Http\Request;

class Restaurars extends Component
{

    use WithFileUploads;
    public $restoreMode = false;
    public $file, $name, $iteration;
    public function render()
    {
        return view('livewire.restaurars.view');
    }
    private function resetInput()
    {   
       
		$this->file = null;
        $this->name = null;
    }
    
    public function cancel()
    {
        //dd($this->name);
        $this->resetInput();
        session()->flash('message', 'Aula actualizada correctamente.');

    }

    public function restore (Request $request)
    {
     
        $path = $this->file->getRealPath();

        $dbHost     =env('DB_HOST');;
        $dbUsername = env('DB_USERNAME');
        $dbPassword = env('DB_PASSWORD');
        $dbName     = env('DB_DATABASE');
        $dbPort     = env('DB_PORT');
        $filePath   = $path;
  
       
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
      $this->resetInput();
      $this->iteration++;
      session()->flash('message', 'La base de datos ha sido restaurada');
      
  }

       
    
}
