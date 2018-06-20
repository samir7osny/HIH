<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventRate extends Model
{
    // Table name
    protected $table = 'events_rate';
    // Primary key
    public $primaryKey = 'event_id';
    // Timestamps
    public $timestamps = false;

    public function event(){
        return $this->belongsTo('App\Event', 'event_id');
    }

    public function guest(){
        return $this->belongsTo('App\Guest', 'guest_id');
    }
}
