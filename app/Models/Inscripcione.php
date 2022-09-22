<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcione extends Model
{
	use HasFactory;
	
    public $timestamps = true; 

    protected $table = 'inscripciones';
    protected $fillable = ['Trimestre','Anyo','estudiante_id','planificacione_id', 'estadoPago'];
	

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function estudiante()
    {
        return $this->hasOne('App\Models\Estudiante', 'id', 'estudiante_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function planificacione()
    {
        return $this->hasOne('App\Models\Planificacione', 'id', 'planificacione_id');
    }
    
}
