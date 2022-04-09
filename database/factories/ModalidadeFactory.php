<?php

namespace Database\Factories;

use App\Models\Modalidade;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ModalidadeFactory extends Factory
{
    protected $model = Modalidade::class;

    public function definition()
    {
        return [
			'TipoModalidad' => $this->faker->name,
        ];
    }
}
