<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LessonResource;
use App\Repositories\LessonRepository;

class LessonController extends Controller
{
    protected $repository;

    public function __construct(LessonRepository $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * Lista aulas a partir de um curso e um módulo
     *
     * @param string $moduleId
     * 
     * @return collection
     */
    public function index($moduleId)
    {
        return LessonResource::collection($this->repository->getAllLessons($moduleId));
    }

    /**
     * Retorna uma aula
     * 
     * @param string $courseId
     * @param string $moduleId
     * @param string $lessonId
     * 
     * @return object
     */
    public function show($moduleId, $lessonId)
    {
        return new LessonResource($this->repository->getLesson($moduleId, $lessonId));
    }
}
