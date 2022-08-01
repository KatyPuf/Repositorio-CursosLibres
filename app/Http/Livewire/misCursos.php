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
use App\Models\EmpresasTelefonica;
class misCursos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $AnyoLectivo, $imagen;
    public $updateMode = false;
    protected $listeners = ['destroy' => 'destroy'];
    public function render()
    {
		
        $keyWord = '%'.$this->keyWord .'%';
        $cursos = Curso::all();
        $modalidades = Modalidade::all();
        $anyos = AnyosLectivo::all();
        $trimestres = Trimestre::all();
        $telefonias = EmpresasTelefonica::all();
        return view('livewire.mis-cursos.view', [
            'misCursos' => planificacione::join('inscripciones', 'planificaciones.id', '=', 'inscripciones.planificacione_id' ) 
                            ->join('estudiantes', 'estudiantes.id', '=', 'inscripciones.estudiante_id')
                            ->join('users', 'users.id', '=', 'estudiantes.user_id')
                            ->join('cursos', 'cursos.id', '=', 'planificaciones.curso_id')
                            ->where('user_id',auth()->user()->id)
                            ->select('modalidad', 'Precio', 'imagen', 'Nombre', 
                            'inscripciones.Id as InscripcionId',
                            'planificaciones.Anyo', 'planificaciones.Trimestre','FechaInicio','FechaFin',
                            'HorarioInicio', 'linkAulaVirtuales', 'planificaciones.Id as PlanificacionId')
                            ->get()
                            
						    
        ],compact('cursos', 'modalidades', 'anyos','trimestres','telefonias'));
    }
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->AnyoLectivo = null;
    }

    public function store()
    {
        
    }

    public function edit($id)
    {
        
    }

    public function update()
    {
        
    }

    public function destroy($id)
    {
      error_log($id);
      error_log("Hellllllll");

      $record = Inscripcione::where('id', $id);
      $record->delete();
        
    }
    public function emitirEvento($id)
    {
        error_log("*******".$id);
        $this->emit('deleteRegistro', $id);

    }
}