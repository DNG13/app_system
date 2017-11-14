<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class App_cosplay extends Model
{
    protected $fillable = [
        'user_id', 'type_id', 'members', 'title', 'fandom','length', 'description',
         'city', 'status', 'comment', 'prev_part',
    ];
}
