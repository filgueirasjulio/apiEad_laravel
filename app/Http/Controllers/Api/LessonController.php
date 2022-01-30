<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Traits\LoggableTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\LessonResource;
use App\Repositories\LessonRepository;

class LessonController extends Controller
{
    use LoggableTrait;

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
        try {
            return LessonResource::collection($this->repository->getAllLessons($moduleId));
        } catch(Exception $e) {
            $this->log('App\Http\Controllers\Api\LessonController - (index)', $e, null, 'daily');

            return response()->json(['message' => $e->getMessage()], 400);
        }  
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
        try {
            return new LessonResource($this->repository->getLesson($moduleId, $lessonId));
        } catch(Exception $e) {
            $this->log('App\Http\Controllers\Api\LessonController - (show)', $e, null, 'daily');

            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
