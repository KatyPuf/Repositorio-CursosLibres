<?php

namespace Database\Factories;

use App\Models\AulaCursoProfesor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AulaCursoProfesorFactory extends Factory
{
    protected $model = AulaCursoProfesor::class;

    public function definition()
    {
        return [
			'profesor_id' => $this->faker->name,
			'curso_ejecutado_id' => $this->faker->name,
			'aula_id' => $this->faker->name,
        ];
    }
}
