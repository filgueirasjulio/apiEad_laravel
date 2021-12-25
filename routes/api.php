<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api as Controller;

Route::get('/courses', [Controller\CourseController::class, 'index']);
Route::get('/courses/{id}', [Controller\CourseController::class, 'show']);

Route::get('/', function() {
    return response()->json([
        'success' => true,
    ]);
});