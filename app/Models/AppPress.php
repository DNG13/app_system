<?php

namespace App\Models;

class AppPress extends Application
{
    protected $fillable = [
        'user_id',
        'type_id',
        'phone',
        'contact_name',
        'social_link',
        'social_links',
        'group_link',
        'members_count',
        'equipment',
        'prev_part',
        'city',
        'camera',
        'media_name',
        'portfolio_link',
        'status',

    ];

    protected $casts = [
        'social_links' => 'array'
    ];

    protected $table = 'app_press';
}
