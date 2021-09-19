<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'subjects';
    protected $fillable = ['name','credits','semester','garant'];

    public function garantName(){
        return $this->hasOne(Teacher::class,'id','garant');
    }
    public function teachers(){
        return $this->belongsToMany(Teacher::class,'sub_teacher','subject_id','teacher_id');
    }
    public function students(){
        return $this->belongsToMany(Student::class,'sub_student','subject_id','student_id');
    }

}
