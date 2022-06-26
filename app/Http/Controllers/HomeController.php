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

    public static function generatePDF()
    {
        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y')
        ];
          
        $pdf = PDF::loadView('myPDF', $data);
    
        return $pdf->download("Bienvenida.pdf");
    }
}
