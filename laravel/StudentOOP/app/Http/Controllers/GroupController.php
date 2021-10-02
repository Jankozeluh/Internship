<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertGroupRequest;
use App\Models\Group;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
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
        foreach ($subjects as $subject) {
            $id->subjects()->attach($subject);
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
        try {
            Group::find($group->id)->students()->attach($request->student);
            foreach ($group->subjects as $subject) {
                foreach ($group->students as $student) {
                    if ($student->id == $request->student) {
                        if (($subject->prereq) != null) {
                            foreach ($subject->prereq as $prereq) {
                                if ($student->passed != null) {
                                    foreach ($student->passed as $passed) {
                                        if ($prereq->prereq == $passed->subject_id) {
                                            $p11 = true;
                                            Student::find($student->id)->subjects()->attach($subject->id);
                                        }
                                    }
                                    if(!(isset($p11))){
                                        throw new \Exception("Student did not finish needed prerequisites of subjects which has the group he wants to enroll.");
                                    }
                                } else {
                                    Group::find($group->id)->students()->detach($request->student);
                                    throw new \Exception("Student did not finish any subjects, so it cannot have passed prerequisites of the subject");
                                }
                            }
                        } else {
                            Student::find($student->id)->subjects()->attach($subject->id);
                        }
                    } else {
                        Group::find($group->id)->students()->detach($request->student);
                        throw new \Exception("Request was probably modified, this student is not in database.");
                    }
                }
            }
        } catch (\Exception $e) {
            return redirect('/groups')->withErrors(json_encode($e));
        }
        return redirect('/groups');
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
        foreach ($group->students as $student) {
            if (!($student->subjects->isEmpty())) {
                foreach ($student->subjects as $sub) {
                    if ($sub->id != $request->subject) {
                        Student::find($student->id)->subjects()->attach($request->subject);
                    }
                }
            } else {
                Student::find($student->id)->subjects()->attach($request->subject);
            }
        }

        Group::find($group->id)->subjects()->attach($request->subject);

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
