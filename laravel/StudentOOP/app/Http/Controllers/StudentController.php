<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertStudentRequest;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
         return view('students.index',[
             'student'=>Student::all()
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(InsertStudentRequest $request)
    {
        $request->validated();
        Student::create([
            'degree' => $request->input('degree', null),
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'credits' => (int)$request->input('credits'),
            'birth' => $request->input('birth'),
            'enrollment' => $request->input('enrollment'),
        ]);

        return redirect('/students');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return view('students.edit')->with('student',Student::find($student->id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(InsertStudentRequest $request, Student $student)
    {
        $request->validated();
        Student::where('id',$student->id)->update([
            'degree' => $request->input('degree', null),
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'credits' => (int)$request->input('credits'),
            'birth' => $request->input('birth'),
            'enrollment' => $request->input('enrollment'),
        ]);
        return redirect('/students');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy(Student $student)
    {
        Student::find($student->id)->delete();
        return redirect('/students');
    }

    /**
     * Show selector of available subjects for the student.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function subject(Student $student){
        $subjects = Subject::whereDoesntHave('students', function ($query) use ($student) {$query->where('student_id', $student->id);})->get();
        return view('students.add.subject')->with('student',Student::find($student->id))->with('subject', $subjects);
    }

    /**
    * Add a subject for student.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Student  $student
    * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
    */
    public function addSubject(Request $request,Student $student){
        Student::find($student->id)->subjects()->attach($request->subject);
        return redirect('/students');
    }

    /**
     * Delete a subject from a student.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
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
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function leave(Student $student){
        if((Student::find($student->id)->credits)>80){
            $student->delete();
            return redirect('/students')->with('success','Student successfully left.');
        }
        return redirect('/students')->with('fail','Student cant left with credits smaller than 80.');
    }
}
