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
        'city',
        'contact_name',
        'social_link',
        'group_link',
        'group_nick',
        'social_links',
        'equipment',
        'block',
        'payment_type',
        'status',
        'electrics',
    ];

    protected $casts = [
        'social_links' => 'array'
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
