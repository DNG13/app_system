<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppPress extends Model
{
    protected $fillable = [
        'user_id',
        'type_id',
        'phone',
        'contact_name',
        'social_links',
        'group_link',
        'members_count',
        'equipment',
        'city',
        'camera',
        'media_name',
        'portfolio_link',
        'status',

    ];

    protected $table = 'app_press';

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'user_id');
    }

    public function type()
    {
        return $this->hasOne(AppType::class, 'id', 'type_id');
    }
}
