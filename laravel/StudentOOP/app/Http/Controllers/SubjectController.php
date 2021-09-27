<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertSubjectRequest;
use App\Models\Group;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        return view('subjects.index', [
            'subject' => Subject::sortable()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('subjects.create')->with('teacher', Teacher::all())->with('subject', Subject::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(InsertSubjectRequest $request)
    {
        $request->validated();
        Subject::create([
            'name' => $request->input('name'),
            'credits' => (int)$request->input('credits'),
            'semester' => (int)$request->input('semester'),
            'garant' => (int)$request->input('garant'),
        ]);

        $id = Subject::where(['name' => $request->input('name'),
            'credits' => (int)$request->input('credits'),
            'semester' => (int)$request->input('semester'),
            'garant' => (int)$request->input('garant')])->first();

        $subjects = $request->input('subject');
        foreach ($subjects as $subject) {
            $id->prerequisites()->attach($subject);
        }


        return redirect('/subjects');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Student $student
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        return view('subjects.show')->with('subject', Subject::find($subject->id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Student $subject
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        return view('subjects.edit')->with('subject', Subject::find($subject->id));
    }

    /**
     * Show avaiable teachers for the subject.
     *
     * @param \App\Models\Subject $subject
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function teacher(Subject $subject)
    {
        $teachers = Teacher::whereDoesntHave('subjects', function ($query) use ($subject) {
            $query->where('subject_id', $subject->id);
        })->get();
        return view('subjects.add.teacher')->with('subject', Subject::find($subject->id))->with('teacher', $teachers);
    }

    /**
     * Add a teacher for subject.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Subject $subject
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function addTeacher(Request $request, Subject $subject)
    {
        Subject::find($subject->id)->teachers()->attach((int)$request->teacher);
        return redirect('/subjects');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Subject $subject
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(InsertSubjectRequest $request, Subject $subject)
    {
        $request->validated();
        Subject::where('id', $subject->id)->update([
            'name' => $request->input('name'),
            'credits' => $request->input('credits'),
            'semester' => $request->input('semester'),
            'garant' => $subject->garant,
        ]);
        return redirect('/subjects');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Subject $subject
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy(Subject $subject)
    {
        Subject::find($subject->id)->delete();
        return redirect('/subjects');
    }

    /**
     * Delete a teacher from a subject.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Subject $subject
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function deleteTeacher(Subject $subject, Request $request)
    {
        Subject::find($subject->id)->teachers()->detach($request->teacherId);
        return redirect('/subjects');
    }

    /**
     * Show avaiable teachers for the subject.
     *
     * @param \App\Models\Subject $subject
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function preEnd(Subject $subject)
    {
        return view('subjects.end')->with('subject', Subject::find($subject->id));
    }
}
