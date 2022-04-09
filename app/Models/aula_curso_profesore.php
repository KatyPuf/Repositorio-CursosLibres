<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class aula_curso_profesore extends Model
{
    protected $table = "aula_curso_profesor";
    protected $fillable = ['profesor_id','curso_ejecutado_id','aula_id'];
    use HasFactory;
}
