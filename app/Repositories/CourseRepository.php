<?php

namespace App\Repositories;

use App\Exceptions\CourseNotFoundException;
use App\Models\Course;

class CourseRepository
{
    protected $model;

    /**
     * @param Course $model
     * 
     * @return void
     */
    public function __construct(Course $model)
    {
        $this->model = $model;
    }

    /**
     * Retorna todos os cursos
     *
     * @return mixed
     */
    public function getAllCourses()
    {
      return  $this->model->with('modules.lessons')->paginate();
    }

    /**
     * Retorna um curso em específico
     * 
     * @param string $identify
     *
     * @return mixed
     */
    public function getCourse($identify)
    {
        return $this->model->with('modules.lessons')->findOrFail($identify);
    
    }
}