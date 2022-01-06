<?php

namespace App\Models;

class AppCosplay extends Application
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
}
