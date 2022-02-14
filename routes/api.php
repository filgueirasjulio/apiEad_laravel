<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api as Controller;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LessonController;

/** não requer autenticação */
    Route::post('/auth', [Controller\AuthController::class, 'auth']);
    Route::post('/forgot', [Controller\AuthController::class, 'forgot'])->middleware('guest');
    Route::post('/reset', [Controller\AuthController::class, 'reset'])->middleware('guest');

    /** requer autenticação */
    Route::post('/logout', [Controller\AuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::get('/me', [Controller\AuthController::class, 'me'])->middleware('auth:sanctum');

    Route::middleware(['auth:sanctum'])->group(function() {
    /** Cursos */
    Route::get('/courses', [Controller\CourseController::class, 'index']);
    Route::get('/courses/{id}', [Controller\CourseController::class, 'show']);

    /** Módulos */
    Route::get('/courses/{id}/modules', [Controller\ModuleController::class, 'index']);

    /** Aulas */
    Route::get('/modules/{moduleId}/lessons', [Controller\LessonController::class, 'index']);
    Route::get('/modules/{moduleId}/lessons/{lessonId}', [Controller\LessonController::class, 'show']);
    Route::post('/lessons/viewed', [Controller\LessonController::class, 'viewed']);

    /** Dúvidas */
    Route::get('/supports/me/', [Controller\SupportController::class, 'mySupports']);
    Route::get('/supports', [Controller\SupportController::class, 'index']);
    Route::post('/supports', [Controller\SupportController::class, 'store']);
    Route::post('/supports/replies/create', [Controller\ReplySupportController::class, 'createReply']);
});

Route::get('/', function() {
    return response()->json([
        'success' => true,
    ]);
});