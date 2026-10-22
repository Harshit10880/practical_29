<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name',
        'enrollment_no',
        'college',
        'semester',
        'subject',
        'email',
        'phone',
    ];
}