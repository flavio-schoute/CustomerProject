<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'date_of_birth'
    ];

    protected $casts = [
        'date_of_birth' => 'date:Y-m-d'
    ];
}
