<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\Group;
use App\Models\Lecture;
use App\Models\Schedule;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Subject;


/**
 *
 */
class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('index', [
            'subject' => Subject::paginate(5),
            'student' => Student::paginate(5),
            'teacher' => Teacher::paginate(5),
            'group' => Group::paginate(5),
            'lecture' => Schedule::paginate(5)->whereNull('pc'),
            'exercise' => Schedule::paginate(5)->whereNotNull('pc'),
        ]);
    }
}
