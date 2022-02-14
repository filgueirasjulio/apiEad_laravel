<?php

namespace App\Repositories;

use App\Models\View;
use App\Models\Lesson;
use App\Traits\BasicTrait;

class LessonRepository
{
  use BasicTrait;

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

  public function markLessonViewed(string $lessonId)
  {
    $user =  $this->getUserAuth();
    $view = $user->views()->where('lesson_id', $lessonId)->first();
   
    if ($view) {
     return $view->update([
        'qty' => $view->qty + 1,
      ]);
    }

    return $user->views()->create([
      'lesson_id' => $lessonId
    ]);
  }
}
