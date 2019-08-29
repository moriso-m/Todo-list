<?php
use App\Post;
use App\Task;

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

// Let homepage be the todo list
Route::get('/','TaskController@index');

// resource controller for easing the creation of functions to handle CRUD
Route::resource('tasks', 'TaskController');

// mark a task as completed
Route::get('tasks/completed/{id}', function ($id) {
    $task = Task::find($id);
    $task->completed = true;
    $task->save();

    return redirect('/')->with('success', 'Task has been completed');
});
Auth::routes();

Route::get('/home', 'TaskController@index')->name('home');

