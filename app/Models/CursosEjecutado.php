<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursosEjecutado extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'cursos_ejecutados';

    protected $fillable = ['Trimestre','Anyo','modalidad','FechaInicio','FechaFin','HorarioInicio','HorarioFin','curso_id'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function aulaCursoProfesors()
    {
        return $this->hasMany('App\Models\AulaCursoProfesor', 'curso_ejecutado_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function curso()
    {
        return $this->hasOne('App\Models\Curso', 'id', 'curso_id');
    }

    public function aulas()
    {
        return $this->belongsToMany('App\Models\Aula', 'aula_curso_profesor', 'curso_ejecutado_id', 'aula_id');
    }

    public function profesores()
    {
        return $this->belongsToMany('App\Models\Profesore', 'aula_curso_profesor', 'curso_ejecutado_id', 'profesor_id');
    }
    
}
