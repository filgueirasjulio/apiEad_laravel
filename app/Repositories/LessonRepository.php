<?php

namespace App\Repositories;

use App\Models\Lesson;

class LessonRepository
{
  protected $model;

  public function __construct(Lesson $model)
  {
    $this->model = $model;
  }

  public function getLessons(string $courseId, string $moduleId)
  {
    return $this->model->whereHas('module', function ($query) use ($moduleId, $courseId) {
      $query->where('id', $moduleId);
      $query->whereHas('course', function ($subquery) use ($courseId) {
        $subquery->where('id', $courseId);
      });
    })->paginate();
  }
}
