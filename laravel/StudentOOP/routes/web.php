<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers;
use App\Models\Student;
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


//Route::get('/students/{students}', [StudentController::class, 'index']);
//
//Route::post('students',[StudentControllerOld::class,'findAction']);
//Route::view("/students",'Student');
////
//Route::post('teacher',[TeacherControllerOld::class,'findAction']);
//Route::view("/teacher",'Teacher');
////
//Route::post('subject',[SubjectControllerOld::class,'findAction']);
//Route::view("/subject",'Subject');

Route::get('/',[HomeController::class,'index']);

Route::prefix('students')->group(function () {
    Route::post('{student}/leave', [StudentController::class,'leave']);
    Route::post('{student}/delete/subject', [StudentController::class,'deleteSubject']);
    Route::post('{student}/add/subject/submit', [StudentController::class,'addSubject']);
    Route::get('{student}/add/subject', [StudentController::class,'subject']);
});
Route::resource('/students', StudentController::class);

Route::prefix('subjects')->group(function () {
    Route::post('{subject}/delete/teacher', [SubjectController::class,'deleteTeacher']);
    Route::post('{subject}/add/teacher/submit', [SubjectController::class,'addTeacher']);
    Route::get('{subject}/add/teacher', [SubjectController::class,'teacher']);
});
Route::resource('/subjects', SubjectController::class);

Route::prefix('teachers')->group(function () {
    Route::post('{teacher}/delete/subject', [TeacherController::class,'deleteSubject']);
    Route::post('{teacher}/add/subject/submit', [TeacherController::class,'addSubject']);
    Route::get('{teacher}/add/subject', [TeacherController::class,'subject']);
});
Route::resource('/teachers', TeacherController::class);


