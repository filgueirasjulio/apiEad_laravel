<?php

namespace App\Http\Controllers\Api;

use App\Traits\Loggable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Repositories\CourseRepository;

class CourseController extends Controller
{
    use Loggable;
    
    protected $repository;

    public function __construct(CourseRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Lista de cursos
     *
     * @return collection
     */
    public function index()
    {
        try {
            return CourseResource::collection($this->repository->getAllCourses());
        } catch(\Exception $e) {
            $this->log('App\Http\Controllers\Api\CourseController - (index)', $e, null, 'daily');
    
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * Retorna um curso
     * 
     * @param string $uuid
     * 
     * @return object
     */
    public function show($uuid)
    { 
        try {
            return new CourseResource($this->repository->getCourse($uuid));
        } catch(\Exception $e) {
            $this->log('App\Http\Controllers\Api\CourseController - (show)', $e, null, 'daily');
    
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
