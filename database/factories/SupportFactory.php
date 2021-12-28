<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Support;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupportFactory extends Factory
{
    protected $model = Support::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           'user_id' => User::first()->id,
           'status' => $this->faker->randomElement(['pending', 'open', 'finished']),
           'description' => $this->faker->sentence(20)
        ];
    }
}
