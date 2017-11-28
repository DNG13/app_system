<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $primaryKey = 'key';
    protected $fillable = ['active',  'title', 'key'];
}
