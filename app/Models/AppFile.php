<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppFile extends Model
{
    protected $table = 'app_files';

    public $timestamps = false;

    protected $fillable = ['app_id',  'link', 'type', 'name', 'temp_id'];
}
