<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'students';
    protected $fillable = ['degree','firstName','lastName','credits','birth','enrollment'];

    public function subjects(){
        return $this->belongsToMany(Subject::class,'sub_student','student_id','subject_id');
    }

}