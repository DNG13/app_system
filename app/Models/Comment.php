<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id',
        'text',
        'app_id',
        'app_kind',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'user_id');
    }

    public function role()
    {
        return $this->hasOne(UserRole::class, 'user_id', 'user_id');
    }
}
