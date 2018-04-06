<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    // Table name
    protected $table = 'member';
    // Primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = false;

    public function headOf() {
        return $this->hasOne('App\Committee', 'head_id');
    }

    public function hihPresident() {
        return $this->hasOne('App\HIH', 'president_id');
    }

    public function committee() {
        return $this->belongsTo('App\Committee', 'committee_id');
    }

    public function moderates(){
        return $this->belongsToMany('App\Workshop', 'moderating_workshops', 'member_id', 'workshop_id');
    }

    public function user() {
        return $this->hasOne('App\User', 'id_of');
    }
}
