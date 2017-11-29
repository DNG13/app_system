<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class App_fair extends Model
{
    protected $fillable = [
        'user_id',
        'type_id',
        'members_count',
        'description',
        'phone',
        'contact_name',
        'social_link',
        'group_link',
        'group_nick',
        'equipment',
        'square',
        'payment_type',
        'status',
        'logo',
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
