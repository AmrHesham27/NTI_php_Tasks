<?php

use App\Http\Controllers\blog;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('index', [TaskController::class, 'index']);

Route::get('addTask', [TaskController::class, 'addTaskPage']);
Route::post('addTaskAction', [TaskController::class, 'addTaskAction']);

Route::get('editTask', [TaskController::class, 'editTaskPage']);
Route::post('editTaskAction', [TaskController::class, 'editTaskAction']);


