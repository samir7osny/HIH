<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventPhoto extends Model
{
    // Table name
    protected $table = 'event_gallary';
    // Primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = false;

    public function event() {//One to many relationship
        return $this->belongsTo('App\Event', 'event_id');
    }
    public function coverOf() {//One to One relationship
        return $this->hasOne('App\Event', 'cover_id');
    }
}
