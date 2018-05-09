<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventEnrollment extends Model
{
    // Table name
    protected $table = 'enrollment_in_events';
    // Primary key
    public $primaryKey = 'event_id';
    // Timestamps
    public $timestamps = false;

    public function event(){//One to One relationship
        return $this->belongsTo('App\Event', 'event_id');
    }

    public function guest(){//One to One relationship
        return $this->belongsTo('App\Guest', 'guest_id');
    }
}
