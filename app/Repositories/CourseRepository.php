<?php

namespace App\Repositories;

use App\Models\Course;

class CourseRepository
{
    protected $model;

    public function __construct(Course $model)
    {
        $this->model = $model;
    }

    public function getAllCourses()
    {
      return  $this->model->paginate();
    }

    public function getCourse($identify)
    {
        return $this->model->findOrFail($identify);
    }
}