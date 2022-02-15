<?php

namespace App\Models;

use App\Models\User;
use App\Models\Available_course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tutorial_request extends Model
{
    use HasFactory;
    protected $table ='tutorial_requests';
    protected $guarded = [];

   
    public function AvaliableCourse()
    {
    return $this->belongsTo(Available_course::class,'available_course_id','id');
    }
    public function student()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

}
