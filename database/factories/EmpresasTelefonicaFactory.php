<?php

namespace Database\Factories;

use App\Models\EmpresasTelefonica;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EmpresasTelefonicaFactory extends Factory
{
    protected $model = EmpresasTelefonica::class;

    public function definition()
    {
        return [
			'Nombre' => $this->faker->name,
        ];
    }
}
