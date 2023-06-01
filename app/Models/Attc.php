<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attc extends Model
{
    use HasFactory;
    protected $table = 'attcs';
    protected $primaryKey = 'id';
    protected $fillable = ['activity_id', 'user_id', 'file'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
