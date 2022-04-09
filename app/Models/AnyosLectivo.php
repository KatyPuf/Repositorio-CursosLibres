<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnyosLectivo extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'anyos_lectivos';

    protected $fillable = ['AnyoLectivo'];
	
}
