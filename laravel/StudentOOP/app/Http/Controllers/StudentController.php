<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertStudentRequest;
use App\Models\Group;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        return view('students.index', [
            'student' => Student::sortable()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(InsertStudentRequest $request)
    {
        $request->validated();
        Student::create([
            'degree' => $request->input('degree', null),
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'credits' => 0,
            'birth' => $request->input('birth'),
            'enrollment' => $request->input('enrollment'),
        ]);

        return redirect('/students');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Student $student
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return view('students.show')->with('student', Student::find($student->id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Student $student
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return view('students.edit')->with('student', Student::find($student->id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Student $student
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(InsertStudentRequest $request, Student $student)
    {
        $request->validated();
        Student::where('id', $student->id)->update([
            'degree' => $request->input('degree', null),
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'credits' => $student->credits,
            'birth' => $request->input('birth'),
            'enrollment' => $request->input('enrollment'),
        ]);
        return redirect('/students');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Student $student
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy(Student $student)
    {
        Student::find($student->id)->delete();
        return redirect('/students');
    }

    /**
     * Delete a subject from a student.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Student $student
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function deleteSubject(Student $student, Request $request)
    {
        Student::find($student->id)->subjects()->detach($request->subId);
        return redirect('/students');
    }

    /**
     * Remove the specified resource from storage when it got 80+ credits.
     *
     * @param \App\Models\Student $student
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function leave(Student $student)
    {
        if ((Student::find($student->id)->credits) > 80) {
            $student->delete();
            return redirect('/students')->with('success', 'Student successfully left.');
        }
        return redirect('/students')->with('fail', 'Student cant left with credits smaller than 80.');
    }

    /**
     * Show selector of available subjects for the student.
     *
     * @param \App\Models\Student $student
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function group(Student $student)
    {
        return view('students.add.group')->with('student', Student::find($student->id))->with('group', Group::all());
    }

    /**
     * Add a subject for student.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Student $student
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function addGroup(Request $request, Student $student)
    {
        Student::find($student->id)->groups()->attach($request->group);
        $rr = array();
        foreach ($student->groups as $group) {
            if (sizeof($group->subjects) > 0) {
                foreach ($group->subjects as $sub) {
                    if (sizeof($sub->prereq) > 0) {
                        if (sizeof($student->passed_subjects) > 0) {
                            foreach ($sub->prereq as $prereq) {
                                foreach ($student->passed_subjects as $passed) {
                                    if ($prereq->id == $passed->id) {
                                        $p[] = $passed->id;
                                    }
                                }
                            }
                            if (sizeof($p) == sizeof($sub->prereq)) {
                                $rr[] = $sub->id;
                            } else {
                                Student::find($student->id)->groups()->detach($request->group);
                                return redirect('/students')->withErrors(['error' => 'Student did not finish needed prerequisites of subjects which has the group he wants to enroll.']);
                            }
                        } else {
                            Student::find($student->id)->groups()->detach($request->group);
                            return redirect('/students')->withErrors(['error' => 'Student did not finish any subjects, so it cannot have passed prerequisites of the subject']);
                        }
                    } else {
                        $rr[] = $sub->id;
                    }
                }
            } else {
                Student::find($student->id)->groups()->attach($request->group);
            }
        }


        if (sizeof($rr) == sizeof(Group::find($request->group)->subjects)) {
            foreach ($rr as $subject) {
                Student::find($student->id)->subjects()->attach($subject);
            }
            return redirect('/students');
        } else {
            return redirect('/students')->withErrors(['error' => 'Student did not finish needed prerequisites of subjects which has the group he wants to enroll, but only some of them.']);
        }
    }
}
