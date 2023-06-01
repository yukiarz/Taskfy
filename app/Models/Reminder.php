<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'reminders';
    protected $primaryKey = 'id';
    protected $fillable = ['description'];

    public function user(){
        return $this->belongsToMany(User::class, 'user_reminder','reminder_id','user_id');
    }
    
}
