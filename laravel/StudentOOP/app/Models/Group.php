<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Group extends Model
{
    use HasFactory;
    use Sortable;
    public $timestamps = false;
    protected $table = 'groups';
    protected $fillable = ['code','semester'];
    public $sortable = ['id','code', 'semester'];

    public function students(){
        return $this->belongsToMany(Student::class,'stu_group','group_id','student_id');
    }

    public function lectures(){
        return $this->hasMany(Schedule::class,'group_id','id')->whereNull('pc');
    }

    public function exercises(){
        return $this->hasMany(Schedule::class,'group_id','id')->whereNotNull('pc');
    }

    public function subjects(){
        return $this->belongsToMany(Subject::class,'sub_group','group_id','subject_id');
    }
}
