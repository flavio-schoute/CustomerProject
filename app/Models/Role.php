<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Role extends Model
{
    use HasFactory;

    public const IS_ADMIN = 1;
    public const IS_TEACHER = 2;
    public const IS_STUDENT = 3;

    public function users(): hasMany
    {
        return $this->hasMany(User::class);
    }
}
