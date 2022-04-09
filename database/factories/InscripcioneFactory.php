<?php

namespace Database\Factories;

use App\Models\Inscripcione;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class InscripcioneFactory extends Factory
{
    protected $model = Inscripcione::class;

    public function definition()
    {
        return [
			'Trimestre' => $this->faker->name,
			'Anyo' => $this->faker->name,
			'estudiante_id' => $this->faker->name,
			'planificacione_id' => $this->faker->name,
        ];
    }
}
