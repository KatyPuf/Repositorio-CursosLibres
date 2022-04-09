<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'cursos';

    protected $fillable = ['Nombre','Semanas','Horas','Precio'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cursosEjecutados()
    {
        return $this->hasMany('App\Models\CursosEjecutado', 'curso_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function planificaciones()
    {
        return $this->hasMany('App\Models\Planificacione', 'curso_id', 'id');
    }
    
}
