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

  public function getAllLessons(string $moduleId)
  {
    return $this->model->whereHas('module', function ($query) use ($moduleId) {
      $query->where('id', $moduleId);
    })->paginate();
  }

  public function getLesson(string $moduleId, string $lessonId)
  {
    return $this->model->whereHas('module', function ($query) use ($moduleId) {
      $query->where('id', $moduleId);
    })->findOrFail($lessonId);
  }
}
