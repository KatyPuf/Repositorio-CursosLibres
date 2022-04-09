<?php

namespace Database\Factories;

use App\Models\CursosEjecutado;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CursosEjecutadoFactory extends Factory
{
    protected $model = CursosEjecutado::class;

    public function definition()
    {
        return [
			'Trimestre' => $this->faker->name,
			'Anyo' => $this->faker->name,
			'FechaInicio' => $this->faker->name,
			'FechaFin' => $this->faker->name,
			'Horario' => $this->faker->name,
			'curso_id' => $this->faker->name,
        ];
    }
}
