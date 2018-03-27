<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    // Table name
    protected $table = 'sponsor';
    // Primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = false;

    public function sponseringEvents(){
        return $this->belongsToMany('App\Event', 'sponsring_events', 'sponser_id', 'event_id');
    }

    public function sponseringWorkshops(){
        return $this->belongsToMany('App\Workshop', 'sponsring_workshops', 'sponser_id', 'workshop_id');
    }
}
