<?php

namespace App\Models;

use App\Models\Tutor;
use App\Models\Course;
use App\Models\Available_course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function getId()
    {
        return $this->id;
    }
    public function Available()
    {
        return $this->hasManyThrough(Available_course::class, Course::class);
    }

    public function RequestDep()
    {
        return $this->hasManyThrough(Tutorial_request::class, Tutor::class);


    }
    public function courses()
    {
        return $this->hasMany(Course::class);

    }



}
