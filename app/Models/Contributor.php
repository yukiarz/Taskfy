<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contributor extends Model
{

    protected $table = 'contributors';

    protected $primaryKey = 'id';

    protected $fillable = ['user_id', 'project_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    
}
