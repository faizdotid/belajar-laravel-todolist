<?php

use App\Http\Controllers\TodolistController;
use App\Http\Controllers\UserController;
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
    return view('user.login', [
        'title' => 'Login'
    ]);
});

Route::controller(UserController::class)->group(function() {
    Route::get('/login', 'login')->name('login')->middleware('onlyguest');
    Route::post('/login', 'doLogin')->middleware('onlyguest');
    Route::post('/logout', 'doLogout')->middleware('onlymember');
    // Route::get('/todolist', 'home')->middleware('onlymember');
});

Route::controller(TodolistController::class)->middleware('onlymember')->group(function() {
    Route::get('/todolist', 'getTodo');
    Route::post('/todolist', 'addTodo');
    Route::post('/todolist/{id}/delete', 'removeTodo');
});