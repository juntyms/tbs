<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutor_comment extends Model
{
    use HasFactory;
    protected $table ='tutor_comments';
    protected $guarded = [];

    public function tutorcomment()
    {
    return $this->belongsTo(Tutorial_request::class,'tutorial_request_id ','id');
    }
}
