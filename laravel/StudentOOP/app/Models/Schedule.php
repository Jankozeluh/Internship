<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Schedule extends Model
{
    use HasFactory;
    use Sortable;

    public $timestamps = false;
    protected $table = 'schedule_inquiries';
    protected $fillable = ['name', 'date', 'pc', 'subject_id', 'teacher_id', 'group_id'];
    public $sortable = ['id', 'name', 'date', 'pc'];

    public function subject()
    {
        return $this->hasOne(Subject::class, 'id', 'subject_id');
    }

    public function teacher()
    {
        return $this->hasOne(Teacher::class, 'id', 'teacher_id');
    }

    public function group()
    {
        return $this->hasOne(Group::class, 'id', 'group_id');
    }
}
