<?php

namespace App\Repositories;

use App\Models\Module;

class ModuleRepository
{
    protected $model;

    public function __construct(Module $model)
    {
        $this->model = $model;
    }

    public function getModulesByCourseId(string $courseId)
    {
      return  $this->model->where('course_id', $courseId)->paginate();
    }
}