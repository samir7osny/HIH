<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkshopEnrollment extends Model
{
    // Table name
    protected $table = 'enrollment_in_workshops';
    // Primary key
    public $primaryKey = ['workshop_id','guest_id'];
    // Timestamps
    public $timestamps = false;

    public function workshop(){
        return $this->belongsTo('App\Workshop', 'workshop_id');
    }

    public function guest(){
        return $this->belongsTo('App\Guest', 'guest_id');
    }
}
