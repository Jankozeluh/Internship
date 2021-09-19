<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'groups';
    protected $fillable = ['code','semester'];

    public function students(){
        return $this->belongsToMany(Student::class,'stu_group','group_id','student_id');
    }
}
