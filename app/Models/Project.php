<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    
    protected $table = 'projects';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'name', 'description', 'start', 'deadline'];

    public function user(){
        return $this->BelongsTo(User::class);
    }

    public function activity(){
        return $this->hasMany(Activity::class);
    }
    
    public function contributor(){
        return $this->hasMany(Contributor::class);
    }
}
