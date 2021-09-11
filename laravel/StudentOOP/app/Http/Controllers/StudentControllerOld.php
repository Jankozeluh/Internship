<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertStudentRequest;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\DB;


class StudentControllerOld extends Controller
{
    public function findAction(\Illuminate\Http\Request $request){
        if ($request->has('delete')) {return $this->delete($request);}
        if ($request->has('leave')) {return $this->leave($request);}
        if ($request->has('insert')) {return $this->insert($request);}
        if ($request->has('subToStudent')) {return $this->insertSubjectStudent($request);}
        return view('/Student');
    }

    public function insertSubjectStudent(Request $request)
    {
        DB::insert('insert into students_sub(id_student,id_subject) values (?,?)', [(int)$request->input('studentOfSub'), (int)$request->input('Subject')]);
        return view('/Student');
    }
    public function insert(Request $request)
    {
        $request->validate([
            'degree' => 'max:10',
            'firstName' => 'string|required|max:100',
            'lastName' => 'string|required|max:100',
            'credits' => 'required',
            'birth' => 'required',
            'enrollment' => 'required',
        ]);
        Student::create([
            'degree' => $request->input('degree', null),
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'credits' => (int)$request->input('credits'),
            'birth' => ((string)date("Y/m/d", strtotime($request->input('birth')))),
            'enrollment' => ((string)date("Y/m/d", strtotime($request->input('enrollment')))),
        ]);
        return view('/Student');
    }
    public function delete(Request $request){
        DB::table('students')->delete((int)$request->input('student'));
        return view('/Student');
    }
    public function leave(Request $request){
        foreach(DB::table('students')->get() as $item){
            if(((int)$item->id === (int)$request->input('st_leave'))) {
                if($item->credits >= 80) {
                    DB::table('students')->delete((int)$request->input('st_leave'));
                }
                else{
                    echo "This student does not have at least 80 credits.";
                }
            }
        }
        return view('/Student');
    }

}
