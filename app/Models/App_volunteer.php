<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class App_volunteer extends Model
{
    protected $fillable = ['user_id', 'experience', 'skills',
        'difficulties', 'status',  'first_name', 'surname',
        'nickname', 'birthday', 'city', 'phone', 'photo'
    ];
}
