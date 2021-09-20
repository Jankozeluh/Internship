<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\Group;
use App\Models\Lecture;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Subject;


class HomeController extends Controller{
    public function index(){
        return view('index',[
            'subject'=>Subject::all(),
            'student'=>Student::all(),
            'teacher'=>Teacher::all(),
            'group'=>Group::all(),
            'lecture'=>Lecture::all(),
            'exercise'=>Exercise::all()
        ]);
    }
}
