<?php

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

Route::get('/',[Controllers\HomeController::class,'index']);

Route::prefix('students')->group(function () {
    Route::post('{student}/leave', [Controllers\StudentController::class,'leave']);
    Route::post('{student}/delete/subject', [Controllers\StudentController::class,'deleteSubject']);
    Route::post('{student}/add/subject/submit', [Controllers\StudentController::class,'addSubject']);
    Route::get('{student}/add/subject', [Controllers\StudentController::class,'subject']);
});
Route::resource('/students', Controllers\StudentController::class);

Route::prefix('subjects')->group(function () {
    Route::post('{subject}/delete/teacher', [Controllers\SubjectController::class,'deleteTeacher']);
    Route::post('{subject}/add/teacher/submit', [Controllers\SubjectController::class,'addTeacher']);
    Route::get('{subject}/add/teacher', [Controllers\SubjectController::class,'teacher']);
});
Route::resource('/subjects', Controllers\SubjectController::class);

Route::prefix('teachers')->group(function () {
    Route::post('{teacher}/delete/subject', [Controllers\TeacherController::class,'deleteSubject']);
    Route::post('{teacher}/add/subject/submit', [Controllers\TeacherController::class,'addSubject']);
    Route::get('{teacher}/add/subject', [Controllers\TeacherController::class,'subject']);
});
Route::resource('/teachers', Controllers\TeacherController::class);

Route::resource('/lectures', Controllers\LectureController::class);
Route::resource('/groups', Controllers\GroupController::class);
Route::resource('/exercises', Controllers\ExerciseController::class);



