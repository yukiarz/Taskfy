<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function project()
    {
        return $this->hasMany(Project::class);
    }

    public function activity()
    {
        return $this->hasMany(Activity::class);
    }

    public function reminder()
    {
        return $this->belongsToMany(Reminder::class, 'user_reminder', 'user_id', 'reminder_id');
    }

    public function userSetting(){
        return $this->hasOne(UserSetting::class);
    }

}
