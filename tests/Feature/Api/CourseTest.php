<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Course;
use Tests\Traits\UtilsTrait;

class CourseTest extends TestCase
{
    use UtilsTrait;

    protected $courses;

    protected function setUp(): void
    {
        parent::setUp();

        $this->courses = Course::factory()->count(10)->create();
    }
  
    public function test_unauthenticated()
    {
        $response = $this->getJson('/courses');

        $response->assertStatus(401);
    }

    public function test_get_all_courses()
    {
       $response = $this->getJson('/courses', $this->defaultHeaders());

       $response->assertStatus(200);
    }

    public function test_get_all_courses_total()
    {
      
       $response = $this->getJson('/courses', $this->defaultHeaders());

       $response->assertStatus(200)
                ->assertJsonCount(10, 'data');
    }

    public function test_get_singles_course_unauthenticated()
    {
        $response = $this->getJson('/courses/fake_id');

        $response->assertStatus(401);
    }

    public function test_get_singles_course_not_found()
    {
        $course = Course::factory()->create();

        $response = $this->getJson("/courses/{$course->id}", $this->defaultHeaders());

        $response->assertStatus(200);
    }
}
