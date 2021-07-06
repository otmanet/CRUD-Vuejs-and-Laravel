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
    return view('Task');
});
Route::get('/getTask', [App\Http\Controllers\TaskController::class, 'index']);
Route::delete('/delete/{id}', [App\Http\Controllers\TaskController::class, 'delete']);
Route::post('/postTask', [App\Http\Controllers\TaskController::class, 'AddTask']);
Route::put('/UpdateTask', [App\Http\Controllers\TaskController::class, 'UpdateTask']);
