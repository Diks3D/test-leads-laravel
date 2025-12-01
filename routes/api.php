<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Middleware\ForceJsonResponse;

Route::fallback(function () {
    abort(404, 'API resource not found');
});

Route::post('login', [AuthController::class, 'login'])->middleware(ForceJsonResponse::class);

Route::middleware(['auth:sanctum', ForceJsonResponse::class])->group(function () {

    Route::get('task', [TaskController::class, 'index']);
    Route::post('task', [TaskController::class, 'store']);
    Route::get('task/{task_uuid}', [TaskController::class, 'show'])->whereUuid('task_uuid');
    Route::put('task/{task_uuid}', [TaskController::class, 'update'])->whereUuid('task_uuid');
    Route::delete('task/{task_uuid}', [TaskController::class, 'destroy'])->whereUuid('task_uuid');

    Route::get('category', [CategoryController::class, 'index']);
    Route::get('category/{category_uuid}', [CategoryController::class, 'show'])->whereUuid('category_uuid');
    Route::post('category', [CategoryController::class, 'store']);
    Route::put('category', [CategoryController::class, 'update']);
    Route::delete('category', [CategoryController::class, 'destroy']);
});
