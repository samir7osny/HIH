<?php

namespace App;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    // Table name
    protected $table = 'guest';
    // Primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = false;

    public function enrollInWorkshops(){
        return $this->hasMany('App\WorkshopEnrollment', 'guest_id');
    }

    public function enrollInEvents(){
        return $this->hasMany('App\EventEnrollment', 'guest_id');
    }

    public function user() {
        return $this->hasOne('App\User', 'id_of')->where('type',1);
    }
    public function isMember(){
        return false;
    }
    public function answersEvents() {
        return $this->hasMany('App\AnswerEvent', 'guest_id');
    }
    public function answersWorkshops() {
        return $this->hasMany('App\AnswerWorkshop', 'guest_id');
    }
}
