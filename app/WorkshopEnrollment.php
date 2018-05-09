<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkshopEnrollment extends Model
{
    // Table name
    protected $table = 'enrollment_in_workshops';
    // Primary key
    public $primaryKey = 'workshop_id';
    // Timestamps
    public $timestamps = false;

    public function workshop(){//One to One relationship
        return $this->belongsTo('App\Workshop', 'workshop_id');
    }

    public function guest(){//One to One relationship
        return $this->belongsTo('App\Guest', 'guest_id');
    }
}
