<?php

namespace App\Models;

use App\Models\Tutorial_request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student_comment extends Model
{
    use HasFactory;
    protected $table ='student_comments';
    protected $guarded = [];

    public function studentcomment()
    {
    return $this->belongsTo(Tutorial_request::class,'tutorial_request_id ','id');
    }
}

