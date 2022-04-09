<?php

namespace Database\Factories;

use App\Models\AnyosLectivo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AnyosLectivoFactory extends Factory
{
    protected $model = AnyosLectivo::class;

    public function definition()
    {
        return [
			'AnyoLectivo' => $this->faker->name,
        ];
    }
}
