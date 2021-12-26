<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Course::factory(5)
            ->has(\App\Models\Module::factory(3)->has(
                \App\Models\Lesson::factory(5)
            ))
            ->create();
    }
}
