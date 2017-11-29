<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $primaryKey = 'user_id';

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'avatar_id',
        'first_name',
        'surname',
        'middle_name',
        'nickname',
        'birthday',
        'city',
        'phone',
        'info',
        'social_links'
    ];


}
