<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Schedule;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Subject;
use Illuminate\Http\Request;


/**
 *
 */
class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $rr = $request['filter'];
        switch ($rr){
            case "1":
                $subject = Subject::paginate(5)->where('semester',1);
                $group = Group::paginate(5)->where('semester',1);
                break;
            case "2":
                $subject = Subject::paginate(5)->where('semester',2);
                $group = Group::paginate(5)->where('semester',1);
                break;
            default:
                $subject = Subject::paginate(5);
                $group = Group::paginate(5);
                break;
        }
        return view('index', [
            'subject' => $subject,
            'student' => Student::paginate(5),
            'teacher' => Teacher::paginate(5),
            'group' => $group,
            'lecture' => Schedule::paginate(5)->whereNull('pc'),
            'exercise' => Schedule::paginate(5)->whereNotNull('pc'),
        ]);
    }
}
