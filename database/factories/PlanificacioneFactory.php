<?php

namespace Database\Factories;

use App\Models\Planificacione;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PlanificacioneFactory extends Factory
{
    protected $model = Planificacione::class;

    public function definition()
    {
        return [
			'Trimestre' => $this->faker->name,
			'Anyo' => $this->faker->name,
			'FechaInicio' => $this->faker->name,
			'FechaFin' => $this->faker->name,
			'HorarioInicio' => $this->faker->name,
            'HorarioFin' => $this->faker->name,
            'imagen' => $this->faker->name,
			'curso_id' => 'planificacion/'.$this->faker->image('public/storage/planificacion',640, 480, null, false) // Si es true ->public/storage/planificacion/img1 - false -> /img1
        ];
    }
}
