<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserReminder extends Model
{
    use HasFactory;
    protected $table = 'user_reminder';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id','reminder_id'];


}
