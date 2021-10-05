<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertTeacherRequest;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        return view('teachers.index', [
            'teacher' => Teacher::sortable()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(InsertTeacherRequest $request)
    {
        $request->validated();
        Teacher::create([
            'degree' => $request->input('degree'),
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'birth' => $request->input('birth'),
        ]);
        return redirect('/teachers');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Teacher $teacher
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        return view('teachers.show')->with('teacher', Teacher::find($teacher->id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        return view('teachers.edit')->with('teacher', Teacher::find($teacher->id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Teacher $teacher
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(InsertTeacherRequest $request, Teacher $teacher)
    {
        $request->validated();
        Teacher::where('id', $teacher->id)->update([
            'degree' => $request->input('degree'),
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'birth' => $request->input('birth'),
        ]);
        return redirect('/teachers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Teacher $teacher
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy(Teacher $teacher)
    {
        Teacher::find($teacher->id)->delete();
        return redirect('/teachers');
    }

    /**
     * Delete a teacher from a teacher.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Teacher $teacher
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function deleteSubject(Teacher $teacher, Request $request)
    {
        Teacher::find($teacher->id)->subjects()->detach($request->subjectId);
        return redirect('/teachers');
    }

    /**
     * Show available subjects for the teacher.
     *
     * @param \App\Models\Teacher $teacher
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function subject(Teacher $teacher)
    {
        $subjects = Subject::whereDoesntHave('teachers', function ($query) use ($teacher) {
            $query->where('teacher_id', $teacher->id);
        })->get();
        return view('teachers.add.subject')->with('teacher', Teacher::find($teacher->id))->with('subject', $subjects);
    }

    /**
     * Add a subject for teacher.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Teacher $teacher
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function addSubject(Request $request, Teacher $teacher)
    {
        Teacher::find($teacher->id)->subjects()->attach((int)$request->subject);
        return redirect('/teachers');
    }
}
