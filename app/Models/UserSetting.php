<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    use HasFactory;
    protected $table = 'user_settings';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id','phone','posisition','level','profile'];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
