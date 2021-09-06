<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Subject;


class PrintController extends Controller{
    public function print(){
        $subjectData = Subject::join('teachers','teachers.id','=','subjects.garant')
            ->get(['teachers.*','subjects.*']);

        $studentData = Student::all();
        $studentSubData = Student::join('students_sub','students.id','=','students_sub.id_student')
            ->join('subjects','students_sub.id_subject','=','subjects.id')
            ->get(['students.id as id','name']);

        $teacherData = Teacher::all();
        $teacherSubData = Subject::join('teachers_sub','subjects.id','=','teachers_sub.id_subject')
            ->join('teachers','teachers.id','=','teachers_sub.id_teacher')
            ->get(['subjects.id as id','teachers.id as idt','teachers.degree','teachers.firstName','teachers.lastName','teachers_sub.exercise','teachers_sub.lecture','subjects.name']);

        return view('viewData',compact('subjectData','studentData','studentSubData','teacherData','teacherSubData'));
    }
}
