<?php

namespace App;


use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    // Table name
    protected $table = 'member';
    // Primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = false;

    public function headOf() {//One to One relationship
        return $this->hasOne('App\Committee', 'head_id');
    }

    public function hihPresident() {//One to One relationship
        return $this->hasOne('App\HIH', 'president_id');
    }

    public function committee() {//Many to One relationship
        return $this->belongsTo('App\Committee', 'committee_id');
    }

    public function moderates(){//Many to many relationship
        return $this->belongsToMany('App\Workshop', 'moderating_workshops', 'member_id', 'workshop_id');
    }

    public function user() {//One to One relationship
        return $this->hasOne('App\User', 'id_of');
    }
    public function isHead(){
        if (DB::table('highboards')->where('member_id',$this->id)->count() != 0) {
            return true;
        }
        return false;
    }
    public function isMember(){
        return true;
    }
}
