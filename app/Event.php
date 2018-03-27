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

    public function Audience(){
        return $this->belongsToMany('App\Guest', 'enrollment_in_events', 'event_id', 'guest_id');
    }

    public function Speakers(){
        return $this->belongsToMany('App\Speaker', 'speakers_in_events', 'event_id', 'speaker_id');
    }

    public function Sponsers(){
        return $this->belongsToMany('App\Sponsor', 'sponsring_events', 'event_id', 'sponser_id');
    }
}
