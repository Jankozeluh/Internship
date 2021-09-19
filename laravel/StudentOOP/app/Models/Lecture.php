<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'lectures';
    protected $fillable = ['name','date','subject_id','teacher_id'];
}
