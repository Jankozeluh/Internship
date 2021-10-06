<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertScheduleInqRequest;
use App\Models\Exercise;
use App\Models\Group;
use App\Models\Lecture;
use App\Models\Schedule;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        return view('schedule_inquiries.index', [
            'lecture' => Schedule::all()->whereNull('pc'),
            'exercise' => Schedule::all()->whereNotNull('pc'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('schedule_inquiries.create')->with('teacher', Teacher::all())->with('group', Group::all())->with('subject', Subject::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(InsertScheduleInqRequest $request)
    {
        Schedule::create([
            'name' => $request->input('name'),
            'date' => $request->input('date'),
            'pc' => $request->input('pc'),
            'subject_id' => $request->input('subject'),
            'teacher_id' => $request->input('teacher'),
            'group_id' => $request->input('group'),
        ]);
        return redirect('/schd_inq');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Schedule $schedule
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($schedule)
    {
        return view('schedule_inquiries.edit')->with('schedule', Schedule::find($schedule))->with('subject', Subject::all())->with('teacher', Teacher::all())->with('group', Group::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Schedule $schedule
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(InsertScheduleInqRequest $request, $schedule)
    {
        $request->validated();
        $pc = Schedule::find($schedule)->pc;
        Schedule::where('id', $schedule)->update([
            'name' => $request->input('name'),
            'date' => $request->input('date'),
            'pc' => $request->input('pc'),
            'subject_id' => $request->input('subject'),
            'teacher_id' => $request->input('teacher'),
            'group_id' => $request->input('group'),
        ]);
        return redirect('/schd_inq');
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($schedule)
    {
        Schedule::find($schedule)->delete();
        return redirect('/schd_inq');
    }

    public function getTeachers($id)
    {
        return json_encode(Subject::find($id)->teachers);
    }

    public function getSubjects($id)
    {
        return json_encode(Group::find($id)->subjects);
    }
}
