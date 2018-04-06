<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    // Table name
    protected $table = 'guest';
    // Primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = false;

    public function enrollInWorkshops(){
        return $this->belongsToMany('App\Workshop', 'enrollment_in_workshops', 'guest_id', 'workshop_id');
    }

    public function enrollInEvents(){
        return $this->belongsToMany('App\Event', 'enrollment_in_events', 'guest_id', 'event_id');
    }

    public function user() {
        return $this->hasOne('App\User', 'id_of');
    }
}
