<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'teachers';
    protected $primaryKey = 'id';
    protected $fillable = ['degree','firstName','lastName','birth'];

    public function subjects(){
        return $this->belongsToMany(Subject::class,'sub_teacher','teacher_id','subject_id');
    }
}
