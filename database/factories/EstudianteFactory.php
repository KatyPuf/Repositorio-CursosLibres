<?php

namespace Database\Factories;

use App\Models\Estudiante;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EstudianteFactory extends Factory
{
    protected $model = Estudiante::class;

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
