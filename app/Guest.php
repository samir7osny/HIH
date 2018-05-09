<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    // Table name
    protected $table = 'guest';
    // Primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = false;

    public function enrollInWorkshops(){//One to many relationship
        return $this->hasMany('App\WorkshopEnrollment', 'guest_id');
    }

    public function enrollInEvents(){//One to many relationship
        return $this->hasMany('App\EventEnrollment', 'guest_id');
    }

    public function user() {//One to One relationship
        return $this->hasOne('App\User', 'id_of');
    }
    public function isMember(){
        return false;
    }
}
