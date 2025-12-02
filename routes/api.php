<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::controller(TaskController::class)
  ->prefix('tasks')
  ->group(function () {
    Route::get('', 'index');
    Route::post('', 'store');
    Route::put('{id}', 'update');
    Route::delete('{id}', 'destroy');
  });
