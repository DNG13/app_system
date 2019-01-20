<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppVolunteer extends Model
{
    protected $fillable = [
        'user_id',
        'experience',
        'skills',
        'difficulties',
        'status',
        'first_name',
        'surname',
        'nickname',
        'age',
        'city',
        'phone',
        'telegram',
        'photo',
        'social_links'
    ];

    protected $table = 'app_volunteers';

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'user_id');
    }

    protected $casts = [
        'social_links' => 'array',
    ];
}
