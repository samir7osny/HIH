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

    public function members() {
        return $this->hasMany('App\Member', 'college_id');
    }

    public function guests() {
        return $this->hasMany('App\Guest', 'college_id');
    }

    public function university() {
        return $this->belongsTo('App\University', 'university_id');
    }    
}
