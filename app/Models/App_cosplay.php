<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class App_cosplay extends Model
{
    protected $fillable = [
        'user_id', 'type_id', 'members', 'title', 'fandom','length', 'description', 'members_count',
         'city', 'status', 'comment', 'prev_part',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'user_id');
    }

    public function type()
    {
        return $this->hasOne(App_type::class, 'id', 'type_id');
    }
}
