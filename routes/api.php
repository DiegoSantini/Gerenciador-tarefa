<?php
// routes/api.php

use App\Http\Controllers\TaskController;

Route::apiResource('tasks', TaskController::class);
Route::patch('tasks/{task}/toggle', [TaskController::class, 'toggle']);
