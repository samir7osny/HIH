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

    public function sponsoringEvents(){//Many to many relationship
        return $this->belongsToMany('App\Event', 'sponsring_events', 'sponsor_id', 'event_id');
    }

    public function sponsoringWorkshops(){//Many to many relationship
        return $this->belongsToMany('App\Workshop', 'sponsring_workshops', 'sponsor_id', 'workshop_id');
    }
}
