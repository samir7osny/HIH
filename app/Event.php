<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    // Table name
    protected $table = 'event';
    // Primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = false;

    public function Audience(){//One to many relationship
        return $this->hasMany('App\EventEnrollment', 'event_id');
    }

    public function Speakers(){//One to many relationship
        return $this->belongsToMany('App\Speaker', 'speakers_in_events', 'event_id', 'speaker_id');
    }

    public function Sponsors(){//One to many relationship
        return $this->belongsToMany('App\Sponsor', 'sponsring_events', 'event_id', 'sponsor_id');
    }
    public function gallery() {//One to many relationship
        return $this->hasMany('App\EventPhoto', 'event_id');
    }
    public function cover() {//One to many relationship
        return $this->belongsTo('App\EventPhoto', 'cover_id');
    }  
}
