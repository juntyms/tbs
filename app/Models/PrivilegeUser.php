<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivilegeUser extends Model
{
    use HasFactory;
    protected $table ='privilege_users';
    protected $guarded = [];
}
