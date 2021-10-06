<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Schedule;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Subject;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;


/**
 *
 */
class HomeController extends Controller
{
    /**
     * * Display a listing of the resource.
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $rr = $request['filter'];
        switch ($rr) {
            case "1":
                $subject = Subject::paginate(5)->where('semester', 1);
                $group = Group::paginate(5)->where('semester', 1);
                $lecture = Schedule::paginate(5)->whereNull('pc')->where('semester', 1);
                $exercise = Schedule::paginate(5)->whereNotNull('pc')->where('semester', 1);
                break;
            case "2":
                $subject = Subject::paginate(5)->where('semester', 2);
                $group = Group::paginate(5)->where('semester', 2);
                $lecture = Schedule::paginate(5)->whereNull('pc')->where('semester', 2);
                $exercise = Schedule::paginate(5)->whereNotNull('pc')->where('semester', 2);
                break;
            default:
                $subject = Subject::paginate(5);
                $group = Group::paginate(5);
                $lecture = Schedule::paginate(5)->whereNull('pc');
                $exercise = Schedule::paginate(5)->whereNotNull('pc');
                break;
        }
        return view('index', [
            'subject' => $subject,
            'student' => Student::paginate(5),
            'teacher' => Teacher::paginate(5),
            'group' => $group,
            'lecture' => $lecture,
            'exercise' => $exercise,
        ]);
    }
}
