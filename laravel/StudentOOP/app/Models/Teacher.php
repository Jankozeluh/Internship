<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Teacher extends Model
{
    use HasFactory;
    use Sortable;
    public $timestamps = false;
    protected $table = 'teachers';
    protected $fillable = ['degree','firstName','lastName','birth'];
    protected $sortable = ['id','degree','firstName','lastName','birth'];

    public function subjects(){
        return $this->belongsToMany(Subject::class,'sub_teacher','teacher_id','subject_id');
    }

    public function lectures(){
        return $this->hasMany(Schedule::class,'teacher_id','id')->whereNull('pc');
    }

    public function exercises(){
        return $this->hasMany(Schedule::class,'teacher_id','id')->whereNotNull('pc');
    }
}
