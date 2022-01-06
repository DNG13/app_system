<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppType extends Model
{
    public $timestamps = false;

    protected $table = 'app_types';

    protected $fillable = ['user_id',  'title', 'app_type', 'slug'];

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'user_id');
    }
}
