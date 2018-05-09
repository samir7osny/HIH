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

    public function timelines() {//One to many relationship
        return $this->hasMany('App\Timeline', 'workshop_id');
    }

    public function moderatedBy(){//Many to many relationship
        return $this->belongsToMany('App\Member', 'moderating_workshops', 'workshop_id', 'member_id');
    }

    public function Audience(){//Many to many relationship
        return $this->hasMany('App\WorkshopEnrollment', 'workshop_id');
    }

    public function Sponsers(){//Many to many relationship
        return $this->belongsToMany('App\Sponsor', 'sponsring_workshops', 'workshop_id', 'sponser_id');
    }

    public function gallery() {//One to many relationship
        return $this->hasMany('App\WorkshopPhoto', 'workshop_id');
    }
    public function cover() {//One to One relationship
        return $this->belongsTo('App\WorkshopPhoto', 'cover_id');
    }  
}
