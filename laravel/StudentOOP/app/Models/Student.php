<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;

class Student extends Model
{
    //use HasFactory;
    use Sortable;

    public $timestamps = false;
    protected $table = 'students';
    protected $fillable = ['degree', 'firstName', 'lastName', 'credits', 'birth', 'enrollment'];
    public $sortable = ['id', 'degree', 'firstName', 'lastName', 'credits', 'birth', 'enrollment'];

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'sub_student', 'student_id', 'subject_id');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'stu_group', 'student_id', 'group_id');
    }

    public function passed_subjects()
    {
        return $this->belongsToMany(Subject::class, 'sub_student_passed', 'student_id', 'subject_id');
    }

}
