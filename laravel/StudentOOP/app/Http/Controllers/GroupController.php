<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertGroupRequest;
use App\Models\Group;
use App\Models\Lecture;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /*
      stu_group
        -group_id
        -student_id

      groups
        -code
        -semester
        -students()
    */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        return view('groups.index',[
            'group'=>Group::sortable()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('groups.create')->with('student',Student::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
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
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        return view('groups.show')->with('group',Group::find($group->id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        return view('groups.edit')->with('group',Group::find($group->id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(InsertGroupRequest $request, Group $group)
    {
        $request->validated();
        Group::where('id',$group->id)->update([
            'code' => $request->input('code'),
            'semester' => $request->input('semester'),
        ]);
        return redirect('/groups');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy(Group $group)
    {
        Group::find($group->id)->delete();
        return redirect('/groups');
    }

    /**
     * Show selector of available subjects for the student.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function student(Group $group){
        $students = Student::doesntHave('groups')->get();
        return view('groups.add.student')->with('group',Group::find($group->id))->with('student', $students);
    }

    /**
     * Add a subject for student.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function addStudent(Request $request,Group $group){
        Group::find($group->id)->students()->attach($request->student);
        return redirect('/groups');
    }
}
