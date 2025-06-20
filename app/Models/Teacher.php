<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'teachers';//database table

    protected $fillable = [
        'name',
        'email',
        'address',
        'phone',
        'experience',
        'qualification',
        'image',
        'status',
    ];//fields which is shown in table 
}
