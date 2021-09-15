<?php

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

//Route::get('/',[PrintController::class,'print']);

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

Route::prefix('students')->group(function () {
    Route::post('{student}/delete/subject', [StudentController::class,'deleteSubject']);
    Route::get('{student}/add/subject', [StudentController::class,'subject']);
    Route::post('{student}/add/subject/submit', [StudentController::class,'addSubject']);
});
Route::resource('/students', StudentController::class);

Route::resource('/teachers', TeacherController::class);
Route::resource('/subjects', SubjectController::class);


