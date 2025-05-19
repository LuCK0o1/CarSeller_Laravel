<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Maker>
 */
class MakerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    //If naming convention is not right
    //protected $model = Maker::class;
    //do not forget to import

    public function definition(): array
    {
        return [
            'name' => fake()->word(),
        ];
    }
}
