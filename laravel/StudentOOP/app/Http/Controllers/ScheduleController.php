<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditScheduleInqRequest;
use App\Http\Requests\InsertScheduleInqRequest;
use App\Models\Group;
use App\Models\Schedule;
use App\Models\Subject;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
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
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('schedule_inquiries.create')->with('teacher', Teacher::all())->with('group', Group::all())->with('subject', Subject::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param InsertScheduleInqRequest $request
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(InsertScheduleInqRequest $request)
    {
        $request->validated();

        $grp = Group::find($request->input('group'));
        $start1 = Carbon::createFromFormat('m-d', '9-13');
        $end1 = Carbon::createFromFormat('m-d', '12-23');
        $start2 = Carbon::createFromFormat('m-d', '2-14');
        $end2 = Carbon::createFromFormat('m-d', '5-27');
        $reqDate = Carbon::createFromFormat('Y-m-d', $request->input('date'));

        if ($reqDate->gte($start1) && $reqDate->lte($end1)) {
            if ($grp->semester == 1) {
                $validDate = true;
            } else {
                return redirect('/schd_inq')->withErrors(['error' => 'Group is not available for semester you choosed date in.']);
            }
        } elseif ($reqDate->gte($start2) && $reqDate->lte($end2)) {
            if ($grp->semester == 2) {
                $validDate = true;
            } else {
                return redirect('/schd_inq')->withErrors(['error' => 'Group is not available for semester you choosed date in.']);
            }
        } else {
            return redirect('/schd_inq')->withErrors(['error' => 'Date you choosed does not belong to any semester.']);
        }

        if (isset($validDate)) {
            Schedule::create([
                'name' => $request->input('name'),
                'date' => $request->input('date'),
                'pc' => $request->input('pc'),
                'subject_id' => $request->input('subject'),
                'teacher_id' => $request->input('teacher'),
                'group_id' => $request->input('group'),
            ]);
        } else {
            return redirect('/schd_inq')->withErrors(['error' => 'Something went wrong.']);
        }

        return redirect('/schd_inq');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Schedule $schedule
     * @return Application|Factory|View
     */
    public function edit($schedule)
    {
        return view('schedule_inquiries.edit')->with('schedule', Schedule::find($schedule));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EditScheduleInqRequest $request
     * @param Schedule $schedule
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(EditScheduleInqRequest $request, $schedule)
    {
        $request->validated();
        $sch = Schedule::find($schedule);

        $grp = $sch->group;
        $start1 = Carbon::createFromFormat('m-d', '9-13');
        $end1 = Carbon::createFromFormat('m-d', '12-23');
        $start2 = Carbon::createFromFormat('m-d', '2-14');
        $end2 = Carbon::createFromFormat('m-d', '5-27');
        $reqDate = Carbon::createFromFormat('Y-m-d', $request->input('date'));

        if ($reqDate->gte($start1) && $reqDate->lte($end1)) {
            if ($grp->semester == 1) {
                $validDate = true;
            } else {
                return redirect('/schd_inq')->withErrors(['error' => 'Group is not available for semester you choosed date in.']);
            }
        } elseif ($reqDate->gte($start2) && $reqDate->lte($end2)) {
            if ($grp->semester == 2) {
                $validDate = true;
            } else {
                return redirect('/schd_inq')->withErrors(['error' => 'Group is not available for semester you choosed date in.']);
            }
        } else {
            return redirect('/schd_inq')->withErrors(['error' => 'Date you choosed does not belong to any semester.']);
        }

        if (isset($validDate)) {
            Schedule::where('id', $schedule)->update([
                'name' => $request->input('name'),
                'date' => $request->input('date'),
                'pc' => $request->input('pc'),
                'subject_id' => $sch->subject->id,
                'teacher_id' => $sch->teacher->id,
                'group_id' => $sch->group->id,
            ]);
        } else {
            return redirect('/schd_inq')->withErrors(['error' => 'Something went wrong.']);
        }


        return redirect('/schd_inq');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return Application|Redirector|RedirectResponse
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
