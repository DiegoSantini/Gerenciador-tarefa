<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::apiResource('tasks', TaskController::class);
Route::patch('/tasks/{task}/toggle', [TaskController::class, 'toggle']);

// Route::get('/tasks', [TaskController::class, 'index']);
// Route::post('/tasks', [TaskController::class, 'store']);
// Route::put('/tasks/{id}', [TaskController::class, 'update']);
// Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);
// Route::patch('/tasks/{id}/toggle', [TaskController::class, 'toggle']);
