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
}
