<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertTeacherRequest;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherControllerOld extends Controller
{
    public function findAction(\Illuminate\Http\Request $request)
    {
        if ($request->has('delete')) {return $this->delete($request);}
        if ($request->has('insert')) {return $this->insert($request);}
        if ($request->has('subToTeacher')) {return $this->insertSubjectTeacher($request);}
        return view('/Subject');
    }
    public function insert(Request $request)
    {
        $request->validate([
            'degree' => 'required|max:10',
            'firstName' => 'required|max:100',
            'lastName' => 'required|max:100',
            'birth' => 'required',
        ]);
            Teacher::create([
                'degree' => $request->input('degree'),
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'birth' => (string)date("Y/m/d", strtotime($request->input('birth'))),
            ]);
        return view('/Teacher');
    }

    public function delete(Request $request){
        DB::table('teachers')->delete((int)$request->input('students'));
        return view('/Teacher');
    }

    public function insertSubjectTeacher(Request $request)
    {
        DB::insert('insert into teachers_sub(id_teacher,id_subject,lecture,exercise) values (?,?,?,?)', [(int)$request->input('teacherOfSub'), (int)$request->input('Subject'),(int)$request->input('lecture'),(int)$request->input('exercise')]);
        return view('/Teacher');
    }

}
