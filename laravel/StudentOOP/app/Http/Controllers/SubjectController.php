<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertSubjectRequest;
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

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
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
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('subjects.create')->with('teacher', Teacher::all())->with('subject', Subject::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Response|Redirector
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
        if ($subjects != null) {
            foreach ($subjects as $subject) {
                $id->prereq()->attach($subject);
            }
        }

        return redirect('/subjects');
    }

    /**
     * Display the specified resource.
     *
     * @param Subject $subject
     * @return Application|Factory|View
     */
    public function show(Subject $subject)
    {
        return view('subjects.show')->with('subject', Subject::find($subject->id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Subject $subject
     * @return Application|Factory|View
     */
    public function edit(Subject $subject)
    {
        return view('subjects.edit')->with('subject', Subject::find($subject->id));
    }

    /**
     * Show avaiable teachers for the subject.
     *
     * @param Subject $subject
     * @return Application
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
     * @param Request $request
     * @param Subject $subject
     * @return Application|RedirectResponse|Redirector
     */
    public function addTeacher(Request $request, Subject $subject)
    {
        Subject::find($subject->id)->teachers()->attach((int)$request->teacher);
        return redirect('/subjects');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Subject $subject
     * @return Application|Redirector|RedirectResponse
     */
    public function update(Request $request, Subject $subject)
    {
        //$request->validated();
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
     * @param Subject $subject
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy(Subject $subject)
    {
        Subject::find($subject->id)->delete();
        return redirect('/subjects');
    }

    /**
     * Delete a teacher from a subject.
     *
     * @param Request $request
     * @param Subject $subject
     * @return Application|Redirector|RedirectResponse
     */
    public function deleteTeacher(Subject $subject, Request $request)
    {
        Subject::find($subject->id)->teachers()->detach($request->teacherId);
        return redirect('/subjects');
    }

    /**
     * Show avaiable teachers for the subject.
     *
     * @param Subject $subject
     * @return Application
     */
    public function preEnd(Subject $subject)
    {
        return view('subjects.end')->with('subject', Subject::find($subject->id));
    }

    /**
     *
     *
     * @param Request $request
     * @param Subject $subject
     * @return Application|Redirector|RedirectResponse
     */
    public function end(Request $request, Subject $subject)
    {
        foreach ($subject->students as $ssubject) {
            $id = $ssubject->id;
            if ($request[$id] >= 1 && $request[$id] <= 4) {
                Student::find($id)->increment('credits', $subject->credits);
                Student::find($id)->passed_subjects()->attach($subject->id);
            }
        }
        Subject::find($subject->id)->delete();
        return redirect('/subjects');
    }

    /**
     * Show avaiable teachers for the subject.
     *
     * @param Subject $subject
     * @return Application
     */
    public function preStudentEnd(Subject $subject, Student $student)
    {
        return view('subjects.studentEnd')->with('subject', Subject::find($subject->id))->with('student', Student::find($student->id));
    }

    /**
     *
     *
     * @param Request $request
     * @param Subject $subject
     * @return Application|Redirector|RedirectResponse
     */
    public function studentEnd(Request $request, Subject $subject, Student $student)
    {
        $id = $student->id;
        if ($request[$id] >= 1 && $request[$id] <= 4) {
            Student::find($id)->increment('credits', $subject->credits);
            Student::find($id)->passed_subjects()->attach($subject->id);
        }
        $student->subjects()->detach($subject->id);
        return redirect('/subjects');
    }
}
