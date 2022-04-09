<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesore extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'profesores';

    protected $fillable = ['Cedula','Nombres','Apellidos','Correo','Celular','EmpresaTelefonica'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function aulas()
    {
        return $this->belongsToMany('App\Models\Aula', 'aula_curso_profesor', 'profesor_id', 'aula_id');
    }

    public function cursosEjecutados()
    {
        return $this->belongsToMany('App\Models\CursosEjecutado', 'aula_curso_profesor', 'profesor_id', 'curso_ejecutado_id');
    }
    
}
