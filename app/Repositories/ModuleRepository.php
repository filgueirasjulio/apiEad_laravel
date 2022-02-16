<?php

namespace App\Repositories;

use App\Models\Module;

class ModuleRepository
{
    protected $model;

    /**
    * @param Module $model
    * 
    * @return void
    */
    public function __construct(Module $model)
    {
        $this->model = $model;
    }

    /**
    * Retorna todos os módulos de um curso
    * 
    * @param string $courseId
    *
    * @return mixed
    */
    public function getAllModules(string $courseId)
    {
      return  $this->model->with('lessons')->where('course_id', $courseId)->paginate();
    }
}