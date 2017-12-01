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
        'birthday',
        'city',
        'phone',
        'photo'
    ];

    protected $table = 'app_volunteers';

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'user_id');
    }
}
