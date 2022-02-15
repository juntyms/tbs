<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Available_course extends Model
{
    use HasFactory;
    protected $table ='available_courses';
    protected $guarded = [];


    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }
    public function Acadmicy()
    {
        return $this->belongsTo('App\Models\Ay');
    }
    public function tutor()
    {
        return $this->belongsTo('App\Models\Tutor');
    }
    
}
