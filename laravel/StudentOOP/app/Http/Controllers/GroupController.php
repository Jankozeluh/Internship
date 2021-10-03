<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertGroupRequest;
use App\Models\Group;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('groups.index', [
            'group' => Group::sortable()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('groups.create')->with('subject', Subject::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param InsertGroupRequest $request
     * @return Application
     */
    public function store(InsertGroupRequest $request)
    {
        $request->validated();
        Group::create([
            'code' => $request->input('code'),
            'semester' => $request->input('semester'),
        ]);

        $id = Group::where('code', $request->input('code'))->first();

        $subjects = $request->input('subject');
        if ($subjects != null) {
            foreach ($subjects as $subject) {
                $id->subjects()->attach($subject);
            }
        }

        return redirect('/groups');
    }

    /**
     * Display the specified resource.
     *
     * @param Group $group
     * @return Application|Factory|View
     */
    public function show(Group $group)
    {
        return view('groups.show')->with('group', Group::find($group->id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Group $group
     * @return Application|Factory|View
     */
    public function edit(Group $group)
    {
        return view('groups.edit')->with('group', Group::find($group->id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Group $group
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(InsertGroupRequest $request, Group $group)
    {
        $request->validated();
        Group::where('id', $group->id)->update([
            'code' => $request->input('code'),
            'semester' => $request->input('semester'),
        ]);
        return redirect('/groups');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Group $group
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(Group $group)
    {
        foreach ($group->subjects as $subject) {
            foreach ($group->students as $student) {
                Student::find($student->id)->subjects()->detach($subject->id);
            }
        }
        Group::find($group->id)->delete();
        return redirect('/groups');
    }

    /**
     * Show selector of available subjects for the student.
     *
     * @param Group $group
     * @return Application
     */
    public function student(Group $group): View
    {
        $students = Student::doesntHave('groups')->get();
        return view('groups.add.student')->with('group', Group::find($group->id))->with('student', $students);
    }

    /**
     * Add a subject for student.
     *
     * @param Request $request
     * @param Group $group
     * @return Application|Redirector|RedirectResponse
     */
    public function addStudent(Request $request, Group $group)
    {
        Group::find($group->id)->students()->attach($request->student);
        $rr = array();
        foreach ($group->subjects as $subject) {
            foreach ($group->students as $student) {
                if ($student->id == (int)$request->student) {
                    if ($subject->prereq != null) {
                        if (sizeof($subject->prereq) > 0) {
                            $p = array();
                            foreach ($subject->prereq as $prereq) {
                                if (!(empty($student->passed_subjects))) {
                                    foreach ($student->passed_subjects as $passed) {
                                        if ($prereq->id == $passed->id) {
                                            $p[] = $passed->id;
                                        }
                                    }
                                } else {
                                    Group::find($group->id)->students()->detach($request->student);
                                    return redirect('/groups')->withErrors(['error' => 'Student did not finish any subjects, so it cannot have passed prerequisites of the subject']);
                                }
                            }
                            if (sizeof($p) == sizeof($subject->prereq)) {
                                $rr[] = $subject->id;
                                //Student::find($student->id)->subjects()->attach($subject->id);
                                //return redirect('/groups')->withErrors(['error' => 'Student did not finish needed prerequisites of subjects which has the group he wants to enroll.']);
                            } else {
                                //ddd($p);
                                Group::find($group->id)->students()->detach($request->student);
                                return redirect('/groups')->withErrors(['error' => 'Student did not finish needed prerequisites of subjects which has the group he wants to enroll.']);
                            }
                        } else {
                            $rr[] = $subject->id;
                            //Student::find($request->student)->subjects()->attach($subject->id);
                        }
                    } else {
                        $rr[] = $subject->id;
                        //Student::find($request->student)->subjects()->attach($subject->id);
                    }
                }
            }
        }
        if (sizeof($rr) == sizeof($group->subjects)) {
            foreach ($rr as $sub) {
                Student::find($request->student)->subjects()->attach($sub);
            }
            return redirect('/groups');
        }else{
            return redirect('/groups')->withErrors(['error' => 'Student did not finish needed prerequisites of subjects which has the group he wants to enroll, but only some of them.']);
        }
        //return redirect('/groups');
    }

    /**
     * Show selector of available subjects for the group.
     *
     * @param \App\Models\Group $group
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function subject(Group $group)
    {
        $subject = Subject::whereDoesntHave('groups', function ($query) use ($group) {
            $query->where('group_id', $group->id);
        })->get();
        return view('groups.add.subject')->with('group', Group::find($group->id))->with('subject', $subject);
    }

    /**
     * Add a subject for group.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Group $group
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function addSubject(Request $request, Group $group)
    {
        $rr = Subject::find($request->subject)->prereq;

        if (sizeof($group->subjects) > 0) {
            //ddd($group->subjects);
            if (sizeof($group->students) > 0) {
                foreach ($group->students as $student) {
                    foreach ($student->subjects as $sub) {
                        if ($sub->id != $request->subject) {
                            if (sizeof($rr) > 0) {
                                foreach ($rr as $prereq) {
                                    foreach ($student->passed_subjects as $passed) {
                                        $ps = array();
                                        if ($passed->id == $prereq->id) {
                                            $ps . array_push($prereq->id);
                                            ddd($ps);
                                            //Student::find($student->id)->subjects()->attach($request->subject);
                                            break;
                                        }
                                    }
                                }
                            }
                        } else {
                            Group::find($group->id)->subjects()->attach($request->subject);
                        }
                    }
                }
            }
        } else {
            Group::find($group->id)->subjects()->attach($request->subject);
        }

        //Group::find($group->id)->subjects()->attach($request->subject);

        return redirect('/groups');
    }


    /*
      stu_group
        -group_id
        -student_id

      groups
        -code
        -semester
        -students()
    */
}
