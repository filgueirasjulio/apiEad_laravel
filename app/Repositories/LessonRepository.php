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

  public function getAllLessons(string $courseId, string $moduleId)
  {
    return $this->model->whereHas('module', function ($query) use ($moduleId, $courseId) {
      $query->where('id', $moduleId);
      $query->whereHas('course', function ($subquery) use ($courseId) {
        $subquery->where('id', $courseId);
      });
    })->paginate();
  }

  public function getLesson(string $courseId, string $moduleId, string $lessonId)
  {
    return $this->model->whereHas('module', function ($query) use ($moduleId, $courseId) {
      $query->where('id', $moduleId);
      $query->whereHas('course', function ($subquery) use ($courseId) {
        $subquery->where('id', $courseId);
      });
    })->where('id', $lessonId)
      ->firstOrFail();
  }
}
