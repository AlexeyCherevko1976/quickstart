<?php

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
    //return view('welcome');
    //return view('tasks');

    // k-6-16 21-15
  $tasks = Task::orderBy('created_at', 'asc')->get();

  return view('tasks', [
    'tasks' => $tasks
  ]);
});

/** app/Http/routes.php
   * Добавить новую задачу 
   */
// k-6-10
  Route::post('/task', function (Request $request) {

  	// k-6-14
    $validator = Validator::make($request->all(), [
    'name' => 'required|max:255',
  	]);

	  if ($validator->fails()) {
	    return redirect('/')
	      ->withInput()
	      ->withErrors($validator);
	  }

// k-6-16
    $task = new Task;
  $task->name = $request->name;
  $task->save();

  return redirect('/');
  });

  /** app/Http/routes.php
   * Удалить задачу
   */
  Route::delete('/task/{task}', function (Task $task) {
    //
  });
