<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertExerciseRequest;
use App\Models\Exercise;
use App\Models\Group;
use App\Models\Lecture;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        return view('exercises.index',[
            'exercise'=>Exercise::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('exercises.create')->with('group',Group::all())->with('subject',Subject::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(InsertExerciseRequest $request)
    {
        $request->validated();
        Exercise::create([
            'name' => $request->input('name'),
            'date' => $request->input('date'),
            'pc' => $request->input('pc'),
            'subject_id' => $request->input('subject'),
            'teacher_id' => $request->input('teacher'),
            'group_id' => $request->input('group'),
        ]);
        return redirect('/exercises');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function show(Exercise $exercise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exercise  $exercise
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Exercise $exercise)
    {
        return view('exercises.edit')->with('exercise',Exercise::find($exercise->id))->with('subject',Subject::all())->with('teacher',Teacher::all())->with('group',Group::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Exercise  $exercise
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(InsertExerciseRequest $request, Exercise $exercise)
    {
        $request->validated();
        Exercise::where('id',$exercise->id)->update([
            'name' => $request->input('name'),
            'date' => $request->input('date'),
            'subject_id' => $request->input('subject'),
            'teacher_id' => $request->input('teacher'),
            'group_id' => $request->input('group'),
            'pc' => $request->input('pc'),
        ]);
        return redirect('/exercises');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exercise  $exercise
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy(Exercise $exercise)
    {
        Exercise::find($exercise->id)->delete();
        return redirect('/exercises');
    }
}
