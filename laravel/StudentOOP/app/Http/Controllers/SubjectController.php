<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertSubjectRequest;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    public function findAction(\Illuminate\Http\Request $request)
    {
        if ($request->has('delete')) {return $this->delete($request);}
        if ($request->has('insert')) {return $this->insert($request);}
        if ($request->has('end')) {return $this->end($request);}
        return view('/Subject');
    }

    public function insert(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'credits' => 'required',
            'semester' => 'required',
            'garant' => 'required',
            'pc' => 'required',
        ]);
        Subject::create([
            'name' => $request->input('name'),
            'credits' => (int)$request->input('credits'),
            'semester' => (int)$request->input('semester'),
            'garant' => (int)$request->input('garant'),
            'pc' => (string)$request->input('pc')
        ]);
        return view('/Subject');
    }
    public function delete(Request $request)
    {
        DB::table('subjects')->delete((int)$request->input('subject_1'));
        return view('/Subject');
    }
    public function end(Request $request)
    {
        $studentJoin = Student::join('students_sub','students.id','=','students_sub.id_student')
            ->join('subjects','subjects.id','=','students_sub.id_subject')->get(['students.id as id','name', 'subjects.credits as credits','id_subject']);
        foreach ($studentJoin as $item){
            if((int)$item->id_subject===(int)$request->input('subject_2')){
                DB::table('students')
                    ->where('id','=',(int)$item->id)
                    ->update(['credits' => DB::raw('credits+'.(int)$item->credits)]);
            }
        }
        DB::table('subjects')->delete((int)$request->input('subject_2'));
        return view('/Subject');
    }
    //public function deleteSubFrom(Request $request){}
}
