<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    protected $fillable = ['user_id', 'link', 'name'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
