<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public const IS_ADMIN = 1;
    public const IS_TEACHER = 2;
    public const IS_STUDENT = 3;


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
