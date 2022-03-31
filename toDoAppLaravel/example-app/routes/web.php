<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

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

/* only not logged in users can visit this routes */
Route::middleware(['notLoggedIn'])->group(function(){
    Route::resource('User' ,UserController::class)->except( ['edit' , 'update'] );
    Route::get('/login', [UserController::class,'loginPage']);
    Route::post('/loginAction', [UserController::class,'loginAction']);
});

/* only logged in */
Route::middleware(['checkUser'])->group(function(){
    Route::resource('Task',TaskController::class)->except('destroy', 'update');
    Route::resource('User',UserController::class)->only( ['edit' , 'update'] );
    Route::get('/logOut', [UserController::class,'logOut']);
});

/* loged in and check task date */
Route::delete('/Task/{id}', [TaskController::class,'destroy'])
->middleware('checkUser', 'checkTaskDate');

Route::put('/Task/{id}', [TaskController::class,'update'])
->middleware('checkUser', 'checkTaskDate');

