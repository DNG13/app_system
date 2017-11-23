<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class App_fair extends Model
{
    protected $fillable = [
        'user_id', 'type_id', 'members_count', 'description', 'phone', 'contact_name', 'social_link', 'group_link',
        'equipment', 'square', 'payment_type', 'status',
    ];
}
