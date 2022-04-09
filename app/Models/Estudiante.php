<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
	use HasFactory;
	
    public $timestamps = false;
    protected $table = 'estudiantes';
    protected $fillable = ['Cedula','Nombres','Apellidos','Correo','Celular','EmpresaTelefonica'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inscripciones()
    {
        return $this->hasMany('App\Models\Inscripcione', 'estudiante_id', 'id');
    }
    
}
