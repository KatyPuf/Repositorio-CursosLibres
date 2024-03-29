<?php

namespace App\Http\Livewire;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Planificacione;
use App\Models\Inscripcione;
use App\Models\Curso;
use App\Models\Estudiante;
use App\Models\AnyosLectivo;
use App\Models\Modalidade;
use App\Models\Trimestre;
use App\Models\CursosEjecutado;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use App\Models\EmpresasTelefonica;
use App\Http\Controllers\HomeController;
use Carbon\Carbon;

use Alert;
use PDF;
class Planificaciones extends Component
{
    use WithPagination;
    use WithFileUploads;
	protected $paginationTheme = 'bootstrap';
    public $selected_id, 
            $keyWord, 
            $keyWordAnyo,
            $keyWordCurso,
            $Trimestre, 
            $Anyo,
            $FechaInicio, 
            $FechaFin, 
            $HorarioInicio, 
            $HorarioFin, 
            $curso_id, $curso,
            $celular, 
            $nombres,
            $apellidos,
            $cedula, 
            $correo, 
            $telefonia,
            $idp,
            $cod, 
            $imagen, 
            $imag,
            $image,
            $imTemp, 
            $modalidad, 
            $btnInscripcion,
            $EmpresaTelefonica,
            $linkAulaVirtuales,
            $idPlanificacion,
            $NombrePlanificacion,
            $listaEstudiantes;
    public $updateMode = false;
    public $Cursos = null;
    public $ottPlatform = '';
    public $selectedAnyo = '';
    public $selectedModalidad = '';
    public $visible =  true;
    public $elementosOcultos = false;
    protected $listeners = ['destroy', 'aperturar', 'generarPdfBienvenida'];
    public $filters = [
        'Anyo' => ''
    ];

   

    public function render()
    {
        
		$keyWord = '%'.$this->selectedModalidad .'%';
        $keyWordAnyo = '%'.$this->selectedAnyo.'%';
        $keyWordCurso= '%'.$this->ottPlatform .'%';
        $keyVisible = '%'.$this->visible .'%';
        $cursos = Curso::all();
        $modalidades = Modalidade::all();
        $anyos = AnyosLectivo::all();
        $trimestres = Trimestre::all();
        $telefonias = EmpresasTelefonica::all();
        return view('livewire.planificaciones.view', [
            'planificaciones' => planificacione::join('cursos', 'planificaciones.curso_id', '=', 'cursos.id' ) 
                            ->where('modalidad', 'LIKE', $keyWord)
                            ->where('Anyo', 'LIKE', $keyWordAnyo)
                            ->where('curso_id', 'LIKE', $keyWordCurso)
                            ->where('visible', 'LIKE', $keyVisible)
                            ->select('modalidad', 'Precio', 'imagen', 'Nombre', 'curso_id',
                            'planificaciones.Anyo', 'planificaciones.Trimestre','FechaInicio','FechaFin',
                            'HorarioInicio', 'HorarioFin', 'linkAulaVirtuales', 'planificaciones.Id as PlanificacionId', 'visible')
                            ->paginate(6)
              		    
        ],compact('cursos', 'modalidades', 'anyos','trimestres','telefonias'));
    }

    protected $rules = [
       
       
        'Anyo' => 'required',
        'Trimestre' => 'required',
        'modalidad'=> 'required',
        'FechaInicio'=> 'required',
        'FechaFin'=> 'required',
        'HorarioInicio'=> 'required',
        'HorarioFin'=> 'required',
        'curso_id'=> 'required',
        'imagen'=> 'required',
        'linkAulaVirtuales'=> 'required',
        'EmpresaTelefonica' => 'required',
        'cedula' => 'required|max:16|min:16',
        'nombres' => 'required|regex:/^[\pL\s\-]+$/u',
        'apellidos' => 'required|regex:/^[\pL\s\-]+$/u',
        'correo' => 'required|email',
        'celular' => 'required|max:8|min:8',
        'EmpresaTelefonica' => 'required',

    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function getPlanificacionProperty ()
    {
        error_log("FILTRANDO");
        return Planificacione::query()
            ->when($this->filters['Anyo'], function($query){
                return $query->where('Anyo', 'like', $this->keyWordAnyo);
            })
            ->with('Cursos')->get();
    }

                      
 
    public function alerta()
    {
        session()->flash('message2', 'Esta planificacion no puede ser eliminada. Tiene estudiantes inscritos');

    }
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
    public function errorBorrar()
    {
        Alert::message('error');
    }
    private function resetInput()
    {	$this->resetErrorBag();
        $this->resetValidation();
		$this->Trimestre = null;
		$this->Anyo = null;
        $this->modalidad = null;
		$this->FechaInicio = null;
		$this->FechaFin = null;
		$this->HorarioInicio = null;
        $this->HorarioFin = null;
		$this->curso_id = null;
        $this->imagen = null;
        $this->linkAulaVirtuales = null;
    }

    public function store(Request $request)
    {
        
        $this->validate([
		'Trimestre' => 'required',
		'Anyo' => 'required',
        'modalidad' => 'required',
		'FechaInicio' => 'required',
		'FechaFin' => 'required',
		'HorarioInicio' => 'required',
        'HorarioFin' => 'required',
		'curso_id' => 'required',
        'linkAulaVirtuales' => 'required',
        'imagen' => 'required|image|max:2048'
        ],[
            'Trimestre.required' => 'Debes seleccionar un trimestre',
            'Anyo.required' => 'Debes seleccionar un año lectivo',
            'curso_id.required' => 'Debes seleccionar un curso',
            'modalidad.required' => 'Debes seleccionar una modalidad',
            'FechaInicio.required' => 'Debes seleccionar una fecha de inicio',
            'FechaFin.required' => 'Debes seleccionar una fecha de finalización',
            'HorarioInicio.required' => 'Debes seleccionar una horario de inicio',
            'HorarioFin.required' => 'Debes seleccionar una horario de finalización',

        ]);

       if($this->verificarPlanificacion($this->Trimestre, $this->curso_id, $this->modalidad, $this->Anyo) >0){
            $this->resetInput();
            $this->emit('closeModal');
            session()->flash('message2', 'No se creó. La planificación ya existe en este trimestre.');
       }else{
           
           $image = $this->imagen->store('planificacion', 'public');
            
            Planificacione::create([ 
                'Trimestre' => $this-> Trimestre,
                'Anyo' => $this-> Anyo,
                'modalidad' => $this-> modalidad,
                'FechaInicio' => $this-> FechaInicio,
                'FechaFin' => $this-> FechaFin,
                'HorarioInicio' => $this-> HorarioInicio,
                'HorarioFin' => $this-> HorarioFin,
                'curso_id' => $this-> curso_id,
                'linkAulaVirtuales' => $this->linkAulaVirtuales,
                'imagen' => $image
            ]);
            
            $this->resetInput();
            $this->emit('closeModal');
            session()->flash('message', 'Planificación creada correctamente.');
        
       }
        
    }

    public function edit($id)
    {
        $record = Planificacione::findOrFail($id);

        $this->selected_id = $id; 
		$this->Trimestre = $record-> Trimestre;
		$this->Anyo = $record-> Anyo;
        $this->modalidad = $record-> modalidad;
		$this->FechaInicio = $record-> FechaInicio;
		$this->FechaFin = $record-> FechaFin;
		$this->HorarioInicio = $record-> HorarioInicio;
        $this->HorarioFin = $record-> HorarioFin;
		$this->curso_id = $record-> curso_id;
        $this->imag = $record->imagen;
        $this->linkAulaVirtuales = $record->linkAulaVirtuales;
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'Trimestre' => 'required',
		'Anyo' => 'required',
        'modalidad' => 'required',
		'FechaInicio' => 'required',
		'FechaFin' => 'required',
		'HorarioInicio' => 'required',
        'HorarioFin' => 'required',
		'curso_id' => 'required',
        'linkAulaVirtuales' => 'required'
        ],[
            'Trimestre.required' => 'Debes seleccionar un trimestre',
            'Anyo.required' => 'Debes seleccionar un año lectivo',
            'curso_id.required' => 'Debes seleccionar un curso',
            'modalidad.required' => 'Debes seleccionar una modalidad',
            'FechaInicio.required' => 'Debes seleccionar una fecha de inicio',
            'FechaFin.required' => 'Debes seleccionar una fecha de finalización',
            'HorarioInicio.required' => 'Debes seleccionar una horario de inicio',
            'HorarioFin.required' => 'Debes seleccionar una horario de finalización',

        ]);

        if ($this->selected_id) {
           if($this->imagen == null){
               $this->image = $this->imag;
           }else{
                $this->image = $this->imagen->store('planificacion', 'public');
           }
            
			$record = Planificacione::find($this->selected_id);
            $record->update([ 
			'Trimestre' => $this-> Trimestre,
			'Anyo' => $this-> Anyo,
            'modalidad' => $this-> modalidad,
			'FechaInicio' => $this-> FechaInicio,
			'FechaFin' => $this-> FechaFin,
			'HorarioInicio' => $this-> HorarioInicio,
            'HorarioFin' => $this-> HorarioFin,
			'curso_id' => $this-> curso_id,
            'linkAulaVirtuales' => $this->linkAulaVirtuales,
            'imagen' =>$this->image
            ]);

            $this->resetInput();
            $this->emit('closeModal');
			session()->flash('message', 'Planificación actualizada correctamente.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Planificacione::where('id', $id);
            $record->delete();
        }
    }

    public function verificarPlanificacion($tri, $curso_id,$modalidad, $anyo){

        $resultado = Planificacione::get()
                    ->where('Trimestre',$tri)
                    ->where('curso_id',$curso_id)
                    ->where('modalidad', $modalidad)
                    ->where('Anyo',$anyo)
                    ->count('curso_id');
                    error_log('------'.$resultado);
        return $resultado;
    }
    
    public function contar($id){
        $resultado = Inscripcione::get()->where('planificacione_id',$id)->count('estudiante_id');
        return $resultado;
    }

    public function aperturar($id){

        date_default_timezone_set("America/Managua");
        setlocale(LC_TIME, 'es_VE.UTF-8','esp');
     
        $record = Planificacione::findOrFail($id);
        CursosEjecutado::create([ 
			'Trimestre' => $record-> Trimestre,
			'Anyo' => $record-> Anyo,
            'modalidad' => $record-> modalidad,
			'FechaInicio' => $record-> FechaInicio,
			'FechaFin' => $record-> FechaFin,
			'HorarioInicio' => $record-> HorarioInicio,
            'HorarioFin' => $record-> HorarioFin,
			'curso_id' => $record-> curso_id,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        //session()->flash('message', 'Curso aperturado.');

    }
   public function buscar($curso_id, $trimestre, $modalidad, $anyo){
       
    $resultado = CursosEjecutado::where("curso_id", $curso_id)
                ->where("Trimestre", $trimestre)
                ->where("modalidad", $modalidad)
                ->where("Anyo", $anyo)
                ->count("curso_id");

        error_log('resultado---'.$resultado);
    
        
       if($resultado >0){
            $response = 1;
        }else{
            $response  = 0;
        }
        return $response;
    }

    public function newInscripcion($id){
        
        $record = Planificacione::findOrFail($id);
        $this->idp = $id; 
       // $this->curso = $record->Trimestre;
        $this->nombres = auth()->user()->name; 
        $this->apellidos = auth()->user()->lastname; 
        $this->cedula = auth()->user()->cedula; 
        $this->celular = auth()->user()->celular; 
        $this->EmpresaTelefonica = auth()->user()->empresaTelefonica; 
        $this->correo = auth()->user()->email; 
        $this->Trimestre = $record->Trimestre;
        $this->modalidad = $record->modalidad;
        $this->Anyo = $record->Anyo;
        $this->curso = $record->curso->Nombre;
        $this->updateMode = true;
       
    }

    public function ValidarInscripcion($id)
    {
        $value =  Inscripcione::findOrFail($id);
        return $value;
    }
    private function resetInputEstudiante()
    {		
		$this->cedula = null;
		$this->nombres = null;
		$this->apellidos = null;
		$this->correo = null;
		$this->celular = null;
		$this->EmpresaTelefonica = null;
        $this->Trimestre = null;
        $this->modalidad = null;
        $this->Anyo = null;

    }

    public function RegisterInscription()
    {
        
        
        $this->validate([
            'cedula' => 'required|max:16|min:16',
            'nombres' => 'required|regex:/^[\pL\s\-]+$/u',
            'apellidos' => 'required|regex:/^[\pL\s\-]+$/u',
            'correo' => 'required|email',
            'celular' => 'required|max:8|min:8',
            'EmpresaTelefonica' => 'required',
            
            
       ],
       ['correo.email' => 'Formato de correo no valido',
        'celular.max' => 'Ingrese máximo 8 digitos',
        'celular.min' => 'Ingrese mínimo 8 digitos',
        'nombres.regex' => 'El nombre no incluye numeros',
        'apellidos.regex' => 'El apellido no incluye numeros',
        'cedula.max' => 'Maximo 16 caracteres para cedula',
        'cedula.min' => 'Maximo 16 caracteres para cedula'

    ]);

       
        if($this->comprobarEstudiante() > 0)
        {
            $est= Estudiante::where('user_id', auth()->user()->id)->get();
            $this->cod = $est[0]->id;
            
        }
        else{
            $est = Estudiante::create([ 
                'Cedula' => $this-> cedula,
                'Nombres' => $this-> nombres,
                'Apellidos' => $this-> apellidos,
                'Correo' => $this-> correo,
                'Celular' => $this-> celular,
                'EmpresaTelefonica' => $this-> EmpresaTelefonica,
                'user_id' => auth()->user()->id
            ]);
    
            $this->cod = $est->id;
            
        }
        
    
      if( $this->validar($this->modalidad, $this->Trimestre, $this->Anyo) == 0)
      {
        date_default_timezone_set("America/Managua");
        setlocale(LC_TIME, 'es_VE.UTF-8','esp');
        
          Inscripcione::create([ 
            'Trimestre' => $this-> Trimestre,
            'Anyo' => $this-> Anyo,
            'estudiante_id' => $this->cod,
            'planificacione_id' => $this-> idp,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        $this->resetInputEstudiante();
        $this->emit('alertInscription', $this->cod);
        $this->emit('closeModal');
        
      }
      else{
        $this->resetInputEstudiante();
        $this->emit('closeModal');
        $this->emit('alertNoInscription', $this->cod);
       
      }
      
        
    }

    public function generarPdfBienvenida($id)
    {
        $record = Estudiante::findOrFail($id);
        $planificacion = Planificacione::findOrFail($this-> idp);
        error_log($planificacion);
        date_default_timezone_set("America/Managua");
        setlocale(LC_TIME, 'es_VE.UTF-8','esp');
        $data = [
          
            'estudiante' => $record->Nombres. ' '. $record->Apellidos,
            'planificacion' => $planificacion->curso->Nombre,
            'modalidad' =>$planificacion->modalidad,
            'horarioInicio' => date('h:i a', strtotime($planificacion->HorarioInicio)),
            'horarioFin' =>date('h:i a', strtotime($planificacion->HorarioFin)),
            'fechaInicio' => $planificacion->FechaInicio ,
            'fechaFin' => $planificacion->FechaFin ,
            'date' => date('m/d/Y')
        ];
          
        $pdfContent = PDF::loadView('livewire.planificaciones.myPDF', $data)->output();
        return response()->streamDownload(
        fn () => print($pdfContent),
         "Bienvenida.pdf"
        );
       
    }
    public function comprobarEstudiante(){

        $ced = Estudiante::get('user_id')
                ->where('user_id', auth()->user()->id)
                ->count('user_id');
        return $ced;
    }

    public function validar($modalidad, $trimestre, $anyo){

        $resultado = planificacione::join('inscripciones', 'inscripciones.planificacione_id', '=', 'planificaciones.id' ) 
                    ->join('estudiantes', 'estudiantes.id', '=', 'inscripciones.estudiante_id')
                    ->where('user_id',auth()->user()->id)
                    ->where('modalidad',$modalidad)
                    ->where('planificaciones.trimestre',$trimestre)
                    ->where('planificaciones.Anyo', $anyo)
                    ->count();
     
        return $resultado;
    }

    public function VerificarEstudianteInscrito( $id)
    {
        $estudiante = Inscripcione::get()
                    ->where('estudiante_id', $id)
                    ->count('estudiante_id');

                    if($estudiante > 0)
                    {
                      $this->btnInscripcion = "Inscrito";
                    }
        return $estudiante;
    }
    public function VerificarInscripcion($id)
    {
        $resultado = estudiante::join('users', 'users.id', '=', 'estudiantes.user_id' ) 
                    ->join('inscripciones', 'inscripciones.estudiante_id', '=', 'estudiantes.id')
                    ->join('planificaciones', 'planificaciones.id', '=', 'inscripciones.planificacione_id')
                    ->where('user_id',auth()->user()->id)
                    ->where('planificacione_id',$id)
                    ->count();
        return $resultado;
    }

    public function verEstudiantes($id)
    {
        $record = Planificacione::where('id', $id);
        $this->listaEstudiantes = estudiante::join('inscripciones', 'inscripciones.estudiante_id', '=', 'estudiantes.id')
        ->join('planificaciones', 'planificaciones.id', '=', 'inscripciones.planificacione_id')
        ->where('planificaciones.id', $id)
        ->get();
        
    
        
    }
    public function cambiarVisibilidad($id, $visible)
    {
        error_log($visible);
        $record = Planificacione::where('id', $id);
        $record->update([ 
			'visible' => $visible]);
        
    }
    public function mostrarTodos()
    {
        
        $this->visible='';
    }

    public function changeEvent($value)
    {
        
        if($value == 1)
        {
            $this->visible='';
        }else{
            $this->visible=true;
        }
    }
}


