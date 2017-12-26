<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $primaryKey = 'key';

    public $incrementing = false;

    protected $table = 'roles';

    protected $fillable = ['key',  'title'];

    public function userRole()
    {
        return $this->hasOne(UserRole::class, 'key', 'key');
    }
}
