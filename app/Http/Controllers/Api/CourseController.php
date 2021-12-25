<?php

namespace App\Http\Controllers\Api;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;

class CourseController extends Controller
{
    /**
     * Lista de cursos
     *
     * @return collection
     */
    public function index()
    {
        $courses = Course::get();

        return CourseResource::collection($courses);
    }

    /**
     * Retorna um curso
     * 
     * @param int $id
     * 
     * @return object
     */
    public function show($id)
    {
        $course = Course::findOrFail($id);

        return new CourseResource($course);
    }
}
