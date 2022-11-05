<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NuevoUsuario;
use App\Models\Curso;
use App\Models\Planificacione;
use App\Models\Inscripcione;
use App\Exports\CursosExport;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\Component;

use PDF;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function pruebaRestore(Request $request)
    {
      
       $path = $request->fullUrl();
        dd($path);
    }

    public function  prueba()
    {
        return view('bienvenida');
    }
    public function sendEmail(){
        $details=[
            'title' => 'Bienvenida',
            'body'  => 'Reciba un cordial saludo. Sea Bienvenido al curso. Exitos'
        ];
        Mail::to('katherinepulido1997@gmail.com')->send(new NuevoUsuario($details));
        return 'Correo enviado';
    }

    public function export($id){
        $resultado =Inscripcione::join("planificaciones", "inscripciones.planificacione_id" , "=", "planificaciones.id")
        ->join ("estudiantes","inscripciones.estudiante_id", "=", "estudiantes.id")
        ->join ("cursos","planificaciones.curso_id", "=", "cursos.id")
        ->where("inscripciones.planificacione_id", $id)
        ->get("cursos.Nombre");
       
       if(count($resultado) >0){
        return Excel::download(new CursosExport($id), 'Reporte de '.$resultado[0]->Nombre.'.xlsx');
        
       }else{
       
        return Excel::download(new CursosExport($id), 'Reporte de Vacio'.'.xlsx');
       }
    }

    public static function generatePDF($modalidad)
    {
        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'estudiante' => '8',
            'planificacion' => '9',
            'modalidad' => $modalidad,
            'date' => date('m/d/Y')
        ];
          
        $pdfContent = PDF::loadView('livewire.planificaciones.myPDF', $data)->output();
        return response()->streamDownload(
        fn () => print($pdfContent),
         "Bienvenida.pdf"
        );
    }

    public function backup_database(){

        //ENTER THE RELEVANT INFO BELOW
        $mysqlHostName      = env('DB_HOST');
        $mysqlUserName      = env('DB_USERNAME');
        $mysqlPassword      = env('DB_PASSWORD');
        $Dbport             = env('DB_PORT');
        $DbName             = env('DB_DATABASE');
        $backup_name        = "mybackup.sql";
    
        
        $queryTables = \DB::select(\DB::raw('SHOW TABLES'));
            foreach ( $queryTables as $table )
            {
                foreach ( $table as $tName)
                {
                    $tables[]= $tName ;
                }
            }
        //$tables             = array("users","aulas","cursos","empleados","estudiantes", "failed_jobs","inscripciones", "migrations", "password_resets","personal_access_tokens","planificaciones","tests"); //here your tables...
    
        $connect = new \PDO("mysql:host=$mysqlHostName;port=$Dbport ;dbname=$DbName;charset=utf8", "$mysqlUserName", "$mysqlPassword",array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        $get_all_table_query = "SHOW TABLES";
        $statement = $connect->prepare($get_all_table_query);
        $statement->execute();
        $result = $statement->fetchAll();
    
    
        $output = '';
        foreach($tables as $table)
        {
         $show_table_query = "SHOW CREATE TABLE " . $table . "";
         $statement = $connect->prepare($show_table_query);
         $statement->execute();
         $show_table_result = $statement->fetchAll();
    
         foreach($show_table_result as $show_table_row)
         {
          $output .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
         }
         $select_query = "SELECT * FROM " . $table . "";
         $statement = $connect->prepare($select_query);
         $statement->execute();
         $total_row = $statement->rowCount();
    
         for($count=0; $count<$total_row; $count++)
         {
          $single_result = $statement->fetch(\PDO::FETCH_ASSOC);
          $table_column_array = array_keys($single_result);
          $table_value_array = array_values($single_result);
          $output .= "\nINSERT INTO $table (";
          $output .= "" . implode(", ", $table_column_array) . ") VALUES (";
          $output .= "'" . implode("','", $table_value_array) . "');\n";
         }
        }
        $file_name = 'CursosLibres_Backup' . '.sql';  //. date('y-m-d') .
        $file_handle = fopen($file_name, 'w+');
        fwrite($file_handle, $output);
        fclose($file_handle);
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file_name));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
           header('Pragma: public');
           header('Content-Length: ' . filesize($file_name));
           ob_clean();
           flush();
           readfile($file_name);
           unlink($file_name);
    
    
    }


    function restoreDatabase(){
        $dbHost     = 'localhost';
        $dbUsername = 'root';
        $dbPassword = '';
        $dbName     = 'laravel';
        $dbPort     ='3306';
        $filePath   = 'C:\Respaldo\CursosLibres_Backup.sql';
  
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
      return redirect()->route('home');
      
  }

}
