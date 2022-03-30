<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
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


Route::get('login', [AdminController::class, 'loginPage']);
Route::post('loginAction', [AdminController::class, 'loginAction']);

Route::get('register', [AdminController::class, 'registerPage']);
Route::post('registerAction', [AdminController::class, 'registerAction']);

Route::get('home', [AdminController::class, 'homePage']);
