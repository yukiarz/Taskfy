<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogTask extends Model
{
    use HasFactory;
    protected $table = 'log_tasks';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'today'];

    public function user(){
        return $this->BelongsTo(User::class);
    }

}
