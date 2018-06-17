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

    public function students() {
        return $this->hasMany('App\User', 'college_id');
    }

    public function university() {
        return $this->belongsTo('App\University', 'university_id');
    }    
}
