<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TaskController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/check_task_status', [TaskController::class, 'check_task_status']);
Route::get('/change_task_status', [TaskController::class, 'change_task_status']);