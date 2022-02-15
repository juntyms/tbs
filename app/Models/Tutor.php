<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tutor extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function gettutorname()
    {
    return $this->belongsTo(User::class,'user_id','id');
    }
}
