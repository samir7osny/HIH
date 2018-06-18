<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventSponsors extends Model
{
        // Table name
        protected $table = 'sponsring_events';
        // Primary key
        public $primaryKey = 'event_id';
        // Timestamps
        public $timestamps = false;
    
        public function event() {
            return $this->belongsTo('App\Event', 'event_id');
        }
        public function sponsor() {
            return $this->belongsTo('App\Sponsor', 'sponsor_id');
        }
}
