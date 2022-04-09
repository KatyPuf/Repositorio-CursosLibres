<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'aulas';

    protected $fillable = ['Nombre','Ubicacion'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function profesores()
    {
        return $this->belongsToMany('App\Models\Profesore', 'aula_curso_profesor', 'aula_id','profesor_id');
    }
    public function cursosEjecutados()
    {
        return $this->belongsToMany('App\Models\CursosEjecutado', 'aula_curso_profesor', 'aula_id','curso_ejecutado_id');
    }
    
}
