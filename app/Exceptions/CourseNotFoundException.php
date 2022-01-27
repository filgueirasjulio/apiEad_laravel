<?php

namespace App\Exceptions;

use Exception;

class CourseNotFoundException extends Exception
{
    protected $message;

    public function __construct(string $uuid)
    {
        $this->message = 'Curso com identificador ' . $uuid . ' não encontrado';
    }

    public function render()
    {
        return response()->json([
            'error' => class_basename($this),
            'code' => 'course_not_found',
            'message' => $this->message,
        ], 400);
    }
}
