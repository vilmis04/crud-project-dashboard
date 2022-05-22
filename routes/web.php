<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\StudentController;
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

Route::get('/', [ProjectController::class, 'index']);
Route::post('/create-project', [ProjectController::class, 'create']);
Route::get('/project/{id}', [ProjectController::class, 'show']);
Route::get('/project/{id}/add-student', [StudentController::class, 'create']);
Route::post('/project/{id}/add-student', [StudentController::class, 'store']);
Route::delete('/project/{project_id}/delete-student/{student_id}', [StudentController::class, 'delete']);