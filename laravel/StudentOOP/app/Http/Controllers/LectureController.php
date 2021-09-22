<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertLectureRequest;
use App\Models\Group;
use App\Models\Lecture;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class LectureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        return view('lectures.index',[
            'lecture'=>Lecture::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('lectures.create')->with('teacher',Teacher::all())->with('group',Group::all())->with('subject',Subject::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(InsertLectureRequest $request)
    {
        //{{--                'name','date','subject_id','teacher_id','group_id'--}}
        $request->validated();
        Lecture::create([
            'name' => $request->input('name'),
            'date' => $request->input('date'),
            'subject_id' => $request->input('subject'),
            'teacher_id' => $request->input('teacher'),
            'group_id' => $request->input('group'),
        ]);
        return redirect('/lectures');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lecture  $lecture
     * @return \Illuminate\Http\Response
     */
    public function show(Lecture $lecture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lecture  $lecture
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Lecture $lecture)
    {
        return view('lectures.edit')->with('lecture',Lecture::find($lecture->id))->with('subject',Subject::all())->with('teacher',Teacher::all())->with('group',Group::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lecture  $lecture
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(InsertLectureRequest $request, Lecture $lecture)
    {
        $request->validated();
        Lecture::where('id',$lecture->id)->update([
            'name' => $request->input('name'),
            'date' => $request->input('date'),
            'subject_id' => $request->input('subject'),
            'teacher_id' => $request->input('teacher'),
            'group_id' => $request->input('group'),
        ]);
        return redirect('/lectures');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lecture  $lecture
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy(Lecture $lecture)
    {
        Lecture::find($lecture->id)->delete();
        return redirect('/lectures');
    }
}
