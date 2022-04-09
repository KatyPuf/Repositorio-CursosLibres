<?php

namespace Database\Factories;

use App\Models\Aula;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AulaFactory extends Factory
{
    protected $model = Aula::class;

    public function definition()
    {
        return [
			'Nombre' => $this->faker->name,
			'Ubicacion' => $this->faker->name,
        ];
    }
}
