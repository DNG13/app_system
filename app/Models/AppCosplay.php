<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppCosplay extends Model
{
    protected $fillable = [
        'user_id',
        'type_id',
        'members',
        'title',
        'fandom',
        'length',
        'description',
        'members_count',
        'city',
        'status',
        'comment',
        'prev_part',
        'group_nick',
        'props',
    ];

    protected $table = 'app_cosplays';

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'user_id');
    }

    public function type()
    {
        return $this->hasOne(AppType::class, 'id', 'type_id');
    }
}
