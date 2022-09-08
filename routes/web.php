<?php

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
Route::resource('todos', \App\Http\Controllers\TodoController::class);
Route::get('todos/{todo}', [\App\Http\Controllers\TodoController::class,'destroy'])->name('todos.destroy');
Route::resource('tasks', \App\Http\Controllers\TaskController::class);
Route::resource('teams', \App\Http\Controllers\TeamController::class);
Route::get('teams/{team}', [\App\Http\Controllers\TeamController::class,'destroy'])->name('teams.destroy');