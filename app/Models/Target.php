<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Target extends Model
{

    protected $table = 'targets';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'name', 'description'];

    
}
