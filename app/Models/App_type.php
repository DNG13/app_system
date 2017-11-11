<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class App_type extends Model
{
    public $timestamps = false;

    protected $fillable = ['user_id',  'title', 'app_type',

    ];
}
