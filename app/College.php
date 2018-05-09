<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    // Table name
    protected $table = 'college';
    // Primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = false;

    public function students() {//One to many relationship
        return $this->hasMany('App\User', 'college_id');
    }

    public function university() {//Many to One relationship
        return $this->belongsTo('App\University', 'university_id');
    }    
}
