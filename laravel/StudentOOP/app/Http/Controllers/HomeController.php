<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Subject;


class HomeController extends Controller{
    public function index(){
        return view('index',[
            'subject'=>Subject::all(),
            'student'=>Student::all(),
            'teacher'=>Teacher::all()
        ]);
    }
}
