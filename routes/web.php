<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\TasksController;
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

Route::get('/', [TodoController::class, 'index']);
Route::post('/todo-new', [TodoController::class, 'create'])->name('todo.new');
Route::post('/task-new', [TasksController::class, 'create'])->name('task.new');
Route::post('/todo-completed-change', [TodoController::class, 'completedChange'])->name('todo.completed.change');
Route::post('/task-completed-change', [TasksController::class, 'completedChange'])->name('task.completed.change');
Route::delete('/todo', [TodoController::class, 'delete'])->name('todo.delete');
Route::delete('/task', [TasksController::class, 'delete'])->name('task.delete');
