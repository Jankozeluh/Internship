<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertGroupRequest;
use App\Models\Group;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

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
        Group::find($group->id)->delete();
        return redirect('/groups');
    }

    /**
     * Show selector of available subjects for the student.
     *
     * @param Group $group
     * @return Application
     */
    public function student(Group $group): Application
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
        Group::find($group->id)->students()->attach($request->student);
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
