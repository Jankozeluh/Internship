<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'exercises';
    protected $fillable = ['name','pc','subject_id','teacher_id','group_id'];

    public function subject(){
        return $this->hasOne(Subject::class,'id','subject_id');
    }

    public function teacher(){
        return $this->hasOne(Teacher::class,'id','teacher_id');
    }

    public function group(){
        return $this->hasOne(Group::class,'id','group_id');
    }
}
