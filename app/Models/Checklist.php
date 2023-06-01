<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{

    protected $table = 'checklists';

    protected $primaryKey = 'id';
    protected $fillable = ['activity_id', 'name', 'description', 'status','created_by','updated_by'];

    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(){
        return $this->belongsTo(User::class, 'updated_by');
    }
    
}
