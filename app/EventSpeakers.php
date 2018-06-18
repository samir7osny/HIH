<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventSpeakers extends Model
{
        // Table name
        protected $table = 'speakers_in_events';
        // Primary key
        public $primaryKey = 'event_id';
        // Timestamps
        public $timestamps = false;
    
        public function event() {
            return $this->belongsTo('App\Event', 'event_id');
        }
        public function speaker() {
            return $this->belongsTo('App\Speaker', 'speaker_id');
        }
}
