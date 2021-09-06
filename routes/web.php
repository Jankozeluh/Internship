<?php

use App\Http\Controllers\PrintController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers;
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

Route::get('/',[PrintController::class,'print']);

Route::post('student',[StudentController::class,'findAction']);
Route::view("/student",'Student');

Route::post('teacher',[TeacherController::class,'findAction']);
Route::view("/teacher",'Teacher');

Route::post('subject',[SubjectController::class,'findAction']);
Route::view("/subject",'Subject');

