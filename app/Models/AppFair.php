<?php

namespace App\Models;

class AppFair extends Application
{
    protected $fillable = [
        'user_id',
        'type_id',
        'members_count',
        'description',
        'phone',
        'city',
        'contact_name',
        'social_link',
        'group_link',
        'group_nick',
        'social_links',
        'equipment',
        'block',
        'payment_type',
        'status',
        'electrics',
    ];

    protected $casts = [
        'social_links' => 'array'
    ];

    protected $table = 'app_fairs';
}
