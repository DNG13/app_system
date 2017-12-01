<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppType extends Model
{
    public $timestamps = false;

    protected $table = 'app_types';

    protected $fillable = ['user_id',  'title', 'app_type'];
}
