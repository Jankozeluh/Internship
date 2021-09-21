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
            'subject'=>Subject::paginate(5),
            'student'=>Student::paginate(5),
            'teacher'=>Teacher::paginate(5),
            'group'=>Group::paginate(5),
            'lecture'=>Lecture::paginate(5),
            'exercise'=>Exercise::paginate(5)
        ]);
    }
}
