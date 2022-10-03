<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Inscripcione;
use App\Models\Estudiante;
use App\Models\Planificacione;
use App\Models\Trimestre;
use App\Models\AnyosLectivo;
use App\Models\Curso;
use Illuminate\Support\Facades\DB;
use App\Support\Collection;
class Inscripciones extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWordTrimestre,  $keyWordEstudiante,  $keyWordCurso,
            $Trimestre, $Anyo, $estudiante_id, $planificacione_id, $estadoPago;
    public $updateMode = false;
    protected $listeners = ['hallChanged' => 'change', 'destroy', 'prueba'];
    public $selectedFecha = '';
    public $selectedEstudiante = '';
    public $selectedCurso = '';
    public $selectedAnyo = '';


    public function render()
    {
        $estudiantes = Estudiante::all();
        $planificaciones = Planificacione::all();
        $trimestres = Trimestre::all();
        $anyos= AnyosLectivo::all();
        $cursos = Curso::all();
		$keyWordFecha = $this->selectedFecha .'%';
		$keyWordCurso = '%'.$this->selectedCurso .'%';
		$keyWordEstudiante = '%'.$this->selectedEstudiante .'%';
		$keyWordAnyo = '%'.$this->selectedAnyo .'%';

        
        $items = (Inscripcione::join('planificaciones','inscripciones.planificacione_id' , '=' ,'planificaciones.id')
        ->join('estudiantes', 'estudiantes.id', '=', 'inscripciones.estudiante_id')
        ->join('cursos', 'cursos.id', '=', 'planificaciones.curso_id')
        ->where('inscripciones.created_at', 'LIKE', $keyWordFecha)
        ->where('estudiante_id', 'LIKE', $keyWordEstudiante)
        ->where('curso_id', 'LIKE', $keyWordCurso)
        ->where('inscripciones.Anyo', 'LIKE', $keyWordAnyo )
        ->select('inscripciones.id as InscripcionId', 'inscripciones.Trimestre',
            'inscripciones.Anyo', 'cursos.Nombre', 'inscripciones.estadoPago',
            'estudiantes.id as EstudianteId', 'estudiantes.Nombres', 'estudiantes.Apellidos',
            'planificaciones.id as PlanificacionId', 'planificaciones.modalidad',
            'inscripciones.created_at'
        )->paginate(10));

        
        return view('livewire.inscripciones.view', [
                            'inscripciones' => $items
						    
        ], compact('estudiantes','planificaciones','trimestres', 'anyos', 'cursos'));
    }
    
    public $filters = [
        'Nombres' => '',
        'Apellidos' => '',
        'Planificacion' => '',
        'Anyo' => '',
        'EstadoPago' => '',
        'Trimestre' => '',

    ];
    public function getInscriptionProperty ()
    {
        return Estudiante::query()
            ->when($this->filters['Nombres'], function($query){
                return $query->where('Nombres', 'like', "{$this->filters['Nombres']}%");
            })
            ->with('Inscripciones')->get();
    }


	public function changeEvent($value, $id)
    {
        
        $record = Inscripcione::find($id);
        if($value == 1)
        {
           
            $record->update([ 
               
                'estadoPago' => 'Pagado',
                
                ]);
            
                $this->updateMode = false;
        }
        else{
           
            $record->update([ 
               
                'estadoPago' => 'Pendiente',
                
                ]);
            
                $this->updateMode = false;
        }
   
    }
    public function cancel()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->Trimestre = null;
		$this->Anyo = null;
		$this->estudiante_id = null;
		$this->planificacione_id = null;
    }

    public function store()
    {
        $this->validate([
		'Trimestre' => 'required',
		'Anyo' => 'required',
		'estudiante_id' => 'required',
		'planificacione_id' => 'required',
        
        ]);

            if($this->validar($this->Trimestre, $this->estudiante_id)==0){
                Inscripcione::create([ 
                    'Trimestre' => $this-> Trimestre,
                    'Anyo' => $this-> Anyo,
                    'estudiante_id' => $this-> estudiante_id,
                    'planificacione_id' => $this-> planificacione_id
                ]);
                
                $this->resetInput();
                $this->emit('closeModal');
                session()->flash('message', 'Inscripción realizada correctamente.');
                
            }
            else{
                $this->resetInput();
                $this->emit('closeModal');
                session()->flash('message2','No se realizó la inscripción. El estudiante tiene matricula en este trimestre');
                
            }
        }
        

    public function edit($id)
    {
        $record = Inscripcione::findOrFail($id);

        $this->selected_id = $id; 
		$this->Trimestre = $record-> Trimestre;
		$this->Anyo = $record-> Anyo;
		$this->estudiante_id = $record-> estudiante_id;
		$this->planificacione_id = $record-> planificacione_id;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'Trimestre' => 'required',
		'Anyo' => 'required',
		'estudiante_id' => 'required',
		'planificacione_id' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Inscripcione::find($this->selected_id);
            $record->update([ 
			'Trimestre' => $this-> Trimestre,
			'Anyo' => $this-> Anyo,
			'estudiante_id' => $this-> estudiante_id,
			'planificacione_id' => $this-> planificacione_id
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Inscripción actualizada correctamente.');
        }
    }

    public function destroy($id)
    {
       
        if ($id) {
            $record = Inscripcione::where('id', $id);
            $record->delete();
        }
    }
   

    public function validar($tri, $id){

        $resultado = Inscripcione::get()
                    ->where('Trimestre',$tri)
                    ->where('estudiante_id',$id)
                    ->count('estudiante_id');
                    error_log('------'.$resultado);
       /* $resultado = DB::table('inscripciones')
        ->join('estudiantes', 'inscripciones.estudiante_id', '=',  'estudiantes.id')
        ->where('trimestre','=',$tri)
        ->where('inscripciones.estudiante_id', '=', $id)
        ->count('inscripciones.estudiante_id');*/
        return $resultado;
    }

    public function misInscripciones(){

        $inscripciones = Inscripcione::all();
                    /*->where('estudiante_id',)
                    ->where('curso_id',$curso_id)
                    ->where('modalidad', $modalidad)
                    ->count('curso_id');*/
        return view('misInscripciones','inscripciones');
    }
    
     public function emitirEvento($id)
    {
        $this->emit('deleteRegistro', $id);

    }
}
