<?php 

namespace App\Models;
use App\Models\Curso;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planificacione extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'planificaciones';
    protected $fillable = [
        'Trimestre',
        'Anyo', 'modalidad','FechaInicio',
        'FechaFin','HorarioInicio',
        'HorarioFin',
        'curso_id', 
        'imagen',
        ];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function curso()
    {
        return $this->hasOne('App\Models\Curso', 'id', 'curso_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inscripciones()
    {
        return $this->hasMany('App\Models\Inscripcione', 'planificacione_id', 'id');
    }
    
}
