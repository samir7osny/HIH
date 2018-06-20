<?php

namespace App;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    // Table name
    protected $table = 'workshop';
    // Primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = false;

    public function timelines() {
        return $this->hasMany('App\Timeline', 'workshop_id');
    }

    public function moderatedBy(){
        return $this->belongsToMany('App\Member', 'moderating_workshops', 'workshop_id', 'member_id');
    }

    public function Audience(){
        return $this->hasMany('App\WorkshopEnrollment', 'workshop_id');
    }

    public function Sponsors(){
        return $this->belongsToMany('App\Sponsor', 'sponsring_workshops', 'workshop_id', 'sponsor_id');
    }

    public function gallery() {
        return $this->hasMany('App\WorkshopPhoto', 'workshop_id');
    }
    public function cover() {
        return $this->belongsTo('App\WorkshopPhoto', 'cover_id');
    }  
    public function questions() {
        return $this->hasMany('App\QuestionWorkshop', 'workshop_id');
    }
    public function enrolled($user_id) {
        $user = \App\User::find($user_id);
        if ($user->type != 1)
            return false;
        $result = DB::table('enrollment_in_workshops')->where('workshop_id',$this->id)->where('guest_id',$user->userInfo->id)->first();
        return $result != null;
    }
    public function rates(){
        return $this->hasMany('App\WorkshopRate', 'workshop_id');
    }
    public function totalRate(){
        return $this->rates->avg('rate');
    }
    public function isGuestRate($user_id){
        $user = \App\User::find($user_id);
        if ($user->type != 1)
            return false;
        $result = DB::table('workshops_rate')->where('workshop_id',$this->id)->where('guest_id',$user->userInfo->id)->first();
        return $result != null;
    }
    public function guestRate($user_id){
        $user = \App\User::find($user_id);
        if ($user->type != 1)
            return 0;
        $result = DB::table('workshops_rate')->where('workshop_id',$this->id)->where('guest_id',$user->userInfo->id)->first();
        return $result->rate;
    }
}
