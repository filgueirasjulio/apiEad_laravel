<?php

namespace Database\Factories;

use App\Models\Lesson;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonFactory extends Factory
{
    protected $model = Lesson::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name =  $this->faker->name();

        return [
            'name' => $name,
            'url' => Str::slug($name),
            'video' => Str::random(),
        ];
    }
}
