<?php

namespace App\Models;

class AppVolunteer extends Application
{
    protected $fillable = [
        'user_id',
        'type_id',
        'experience',
        'skills',
        'difficulties',
        'status',
        'first_name',
        'surname',
        'nickname',
        'age',
        'city',
        'phone',
        'telegram',
        'photo',
        'social_links'
    ];

    protected $table = 'app_volunteers';

    protected $casts = [
        'social_links' => 'array',
    ];
}
