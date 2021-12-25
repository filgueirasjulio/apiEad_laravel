<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Repositories\CourseRepository;

class CourseController extends Controller
{
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
        return CourseResource::collection($this->repository->getAllCourses());
    }

    /**
     * Retorna um curso
     * 
     * @param string $id
     * 
     * @return object
     */
    public function show($id)
    {
        return new CourseResource($this->repository->getCourse($id));
    }
}
