<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    // Table name
    protected $table = 'workshop';
    // Primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = false;

    public function timelines() {
        return $this->hasMany('App\Timline', 'workshop_id');
    }

    public function moderatedBy(){
        return $this->belongsToMany('App\Member', 'moderating_workshops', 'workshop_id', 'member_id');
    }

    public function Audience(){
        return $this->belongsToMany('App\Guest', 'enrollment_in_workshops', 'workshop_id', 'guest_id');
    }

    public function Sponsers(){
        return $this->belongsToMany('App\Sponsor', 'sponsring_workshops', 'workshop_id', 'sponser_id');
    }
}
