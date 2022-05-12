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

class Planificaciones extends Component
{
    use WithPagination;
    use WithFileUploads;
	protected $paginationTheme = 'bootstrap';
    public $selected_id, 
            $keyWord, 
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
            $EmpresaTelefonica;
    public $updateMode = false;
    public $Cursos = null;
    
    public function render()
    {
        
        
		$keyWord = '%'.$this->keyWord .'%';
        $cursos = Curso::all();
        $modalidades = Modalidade::all();
        $anyos = AnyosLectivo::all();
        $trimestres = Trimestre::all();
        $telefonias = EmpresasTelefonica::all();
        return view('livewire.planificaciones.view', [
            'planificaciones' => Planificacione::latest('id')
						->orWhere('Trimestre', 'LIKE', $keyWord)
						->orWhere('Anyo', 'LIKE', $keyWord)
                        ->orWhere('modalidad', 'LIKE', $keyWord)
						->orWhere('FechaInicio', 'LIKE', $keyWord)
						->orWhere('FechaFin', 'LIKE', $keyWord)
						->orWhere('HorarioInicio', 'LIKE', $keyWord)
                        ->orWhere('HorarioFin', 'LIKE', $keyWord)
						->orWhere('curso_id', 'LIKE', $keyWord)
						->paginate(10),
        ],compact('cursos', 'modalidades', 'anyos','trimestres','telefonias'));
    }
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->Trimestre = null;
		$this->Anyo = null;
        $this->modalidad = null;
		$this->FechaInicio = null;
		$this->FechaFin = null;
		$this->HorarioInicio = null;
        $this->HorarioFin = null;
		$this->curso_id = null;
        $this->imagen = null;

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
        'imagen' => 'required|image|max:2048',
        ]);

       if($this->verificarPlanificacion($this->Trimestre, $this->curso_id, $this->modalidad) >0){
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
            'imagen' =>$this->image
            ]);

            $this->resetInput();
            $this->updateMode = false;
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

    public function verificarPlanificacion($tri, $curso_id,$modalidad){

        $resultado = Planificacione::get()
                    ->where('Trimestre',$tri)
                    ->where('curso_id',$curso_id)
                    ->where('modalidad', $modalidad)
                    ->count('curso_id');
                    error_log('------'.$resultado);
        return $resultado;
    }
    public function contar($id){
        $resultado = Inscripcione::get()->where('planificacione_id',$id)->count('estudiante_id');
        return $resultado;
    }

    public function aperturar($id){
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
        ]);
        session()->flash('message', 'Curso aperturado.');

    }
   public function buscar($curso_id, $trimestre){
       
    $resultado = CursosEjecutado::where("curso_id", $curso_id)
                ->where("Trimestre", $trimestre)
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
        $this->cedula = $record->cedula; 
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
            'cedula' => 'required',
            'nombres' => 'required',
            'apellidos' => 'required',
            'correo' => 'required',
            'celular' => 'required',
            'EmpresaTelefonica' => 'required',
            
            
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
        
    
      if( $this->validar($this->modalidad, $this->Trimestre) == 0)
      {
          Inscripcione::create([ 
            'Trimestre' => $this-> Trimestre,
            'Anyo' => $this-> Anyo,
            'estudiante_id' => $this->cod,
            'planificacione_id' => $this-> idp
        ]);

        $this->resetInputEstudiante();
        $this->emit('closeModal');
        session()->flash('message', 'Inscripción realizada correctamente.');
      }
      else{
        $this->resetInputEstudiante();
        $this->emit('closeModal');
        session()->flash('message2', 'No se realizó la inscripción. Usted tiene una matricula en esta modalidad.');

      }

        
        
    }

    
    public function comprobarEstudiante(){

        $ced = Estudiante::get('user_id')
                ->where('user_id', auth()->user()->id)
                ->count('user_id');
        return $ced;
    }

    public function validar($modalidad, $trimestre){

        $resultado = planificacione::join('inscripciones', 'inscripciones.planificacione_id', '=', 'planificaciones.id' ) 
                    ->join('estudiantes', 'estudiantes.id', '=', 'inscripciones.estudiante_id')
                    ->where('user_id',auth()->user()->id)
                    ->where('modalidad',$modalidad)
                    ->where('planificaciones.trimestre',$trimestre)
                    ->count();
     
                    error_log('------'.$resultado);
                    error_log('------c'.auth()->user()->id." ".$modalidad);

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
        $listaEstudiantes = estudiante::join('inscripciones', 'inscripciones.estudiante_id', '=', 'estudiantes.id')
        ->join('planificaciones', 'planificaciones.id', '=', 'inscripciones.planificacione_id')
        ->where('planificaciones.id', $id)
        ->get();
        
        return $listaEstudiantes;
        
    }
}


