<?php

namespace Database\Factories;

use App\Models\Profesore;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProfesoreFactory extends Factory
{
    protected $model = Profesore::class;

    public function definition()
    {
        return [
			'Cedula' => $this->faker->name,
			'Nombres' => $this->faker->name,
			'Apellidos' => $this->faker->name,
			'Correo' => $this->faker->name,
			'Celular' => $this->faker->name,
			'EmpresaTelefonica' => $this->faker->name,
        ];
    }
}
