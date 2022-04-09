<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trimestre extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'trimestres';

    protected $fillable = ['Nombre','Estado'];
	
}
