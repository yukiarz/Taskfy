<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{

    protected $table = 'activities';
    protected $primaryKey = 'id';
    protected $fillable = ['project_id', 'user_id', 'name', 'description'];

    public function checklist(){
        return $this->hasMany(Checklist::class);
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function attc(){
        return $this->hasMany(Attc::class);
    }

}
