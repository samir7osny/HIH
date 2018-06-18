<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkshopSponsors extends Model
{
        // Table name
        protected $table = 'sponsring_workshops';
        // Primary key
        public $primaryKey = 'workshop_id';
        // Timestamps
        public $timestamps = false;
    
        public function workshop() {
            return $this->belongsTo('App\Event', 'workshop_id');
        }
        public function sponsor() {
            return $this->belongsTo('App\Sponsor', 'sponsor_id');
        }
}
