<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppFair extends Model
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

    protected $table = 'app_fairs';

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'user_id');
    }

    public function type()
    {
        return $this->hasOne(AppType::class, 'id', 'type_id');
    }
}
