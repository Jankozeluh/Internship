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
}
