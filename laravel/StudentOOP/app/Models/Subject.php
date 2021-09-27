<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Subject extends Model
{
    use HasFactory;
    use Sortable;
    public $timestamps = false;
    protected $table = 'subjects';
    protected $fillable = ['name','credits','semester','garant'];
    public $sortable = ['id', 'name', 'credits', 'semester', 'garant'];

    public function garantName(){
        return $this->hasOne(Teacher::class,'id','garant');
    }

    public function teachers(){
        return $this->belongsToMany(Teacher::class,'sub_teacher','subject_id','teacher_id');
    }

    public function students(){
        return $this->belongsToMany(Student::class,'sub_student','subject_id','student_id');
    }

    public function lectures(){
        return $this->hasMany(Schedule::class,'subject_id','id')->whereNull('pc');
    }

    public function exercises(){
        return $this->hasMany(Schedule::class,'subject_id','id')->whereNotNull('pc');
    }

    //?
    public function prerequisites(){
        return $this->belongsToMany(Subject::class,'prerequisites','owner','prereq');
    }
}
