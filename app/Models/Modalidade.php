<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modalidade extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'modalidades';

    protected $fillable = ['TipoModalidad'];
	
}
