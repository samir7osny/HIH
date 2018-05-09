<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkshopPhoto extends Model
{
    // Table name
    protected $table = 'workshop_gallary';
    // Primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = false;

    public function workshop() {//One to One relationship
        return $this->belongsTo('App\Workshop', 'workshop_id');
    }
    public function coverOf() {//One to one relationship
        return $this->hasOne('App\Workshop', 'cover_id');
    }
}
