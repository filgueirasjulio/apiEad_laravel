<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ModuleResource;
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
     * @param string $courseId
     * @param string $moduleId
     * 
     * @return collection
     */
    public function index($courseId, $moduleId)
    {
        return ModuleResource::collection($this->repository->getLessons($courseId, $moduleId));
    }
}
