<?php

use App\Http\Controllers;
use App\Http\Controllers\ExerciseController;
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

Route::get('exercises/getTeachers/{id}',[Controllers\ExerciseController::class, 'getTeachers'])->name('getTeachers');
Route::get('lectures/getTeachers/{id}',[Controllers\LectureController::class, 'getTeachers'])->name('getTeachers');


Route::get('/',[Controllers\HomeController::class,'index']);

Route::prefix('students')->group(function () {
    Route::post('{student}/leave', [Controllers\StudentController::class,'leave']);
    Route::post('{student}/delete/subject', [Controllers\StudentController::class,'deleteSubject']);
    Route::post('{student}/add/subject/submit', [Controllers\StudentController::class,'addSubject']);
    Route::post('{student}/add/group/submit', [Controllers\StudentController::class,'addGroup']);

    Route::get('{student}/add/subject', [Controllers\StudentController::class,'subject']);
    Route::get('{student}/add/group', [Controllers\StudentController::class,'group']);
});
Route::resource('/students', Controllers\StudentController::class);

Route::prefix('subjects')->group(function () {
    Route::post('{subject}/delete/teacher', [Controllers\SubjectController::class,'deleteTeacher']);
    Route::post('{subject}/add/teacher/submit', [Controllers\SubjectController::class,'addTeacher']);
    Route::post('{subject}/end/submit', [Controllers\SubjectController::class,'end']);

    Route::get('{subject}/add/teacher', [Controllers\SubjectController::class,'teacher']);
    Route::get('{subject}/end', [Controllers\SubjectController::class,'preEnd']);
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
Route::prefix('groups')->group(function () {
    Route::post('{group}/delete/student', [Controllers\GroupController::class,'deleteStudent']);
    Route::post('{group}/add/student/submit', [Controllers\GroupController::class,'addStudent']);
    Route::get('{group}/add/student', [Controllers\GroupController::class,'student']);
});
Route::resource('/exercises', Controllers\ExerciseController::class);



