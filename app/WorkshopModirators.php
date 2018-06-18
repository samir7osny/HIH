<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkshopModirators extends Model
{
        // Table name
        protected $table = 'moderating_workshops';
        // Primary key
        public $primaryKey = 'workshop_id';
        // Timestamps
        public $timestamps = false;
    
        public function workshop() {
            return $this->belongsTo('App\Workshop', 'workshop_id');
        }
        public function Modirator() {
            return $this->belongsTo('App\Member', 'member_id');
        }
}
