<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AulaCursoProfesor extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'aula_curso_profesor';

    protected $fillable = ['profesor_id','curso_ejecutado_id','aula_id'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function aula()
    {
        return $this->hasOne('App\Models\Aula', 'id', 'aula_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cursosEjecutado()
    {
        return $this->hasOne('App\Models\CursosEjecutado', 'id', 'curso_ejecutado_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profesore()
    {
        return $this->hasOne('App\Models\Profesore', 'id', 'profesor_id');
    }
    
}
