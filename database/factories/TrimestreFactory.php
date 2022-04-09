<?php

namespace Database\Factories;

use App\Models\Trimestre;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TrimestreFactory extends Factory
{
    protected $model = Trimestre::class;

    public function definition()
    {
        return [
			'Nombre' => $this->faker->name,
			'Estado' => $this->faker->name,
        ];
    }
}
