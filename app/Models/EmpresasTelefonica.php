<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpresasTelefonica extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'empresas_telefonicas';

    protected $fillable = ['Nombre'];
	
}
