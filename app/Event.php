<?php

namespace App;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    // Table name
    protected $table = 'event';
    // Primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = false;

    public function Audience(){
        return $this->hasMany('App\EventEnrollment', 'event_id');
    }

    public function Speakers(){
        return $this->belongsToMany('App\Speaker', 'speakers_in_events', 'event_id', 'speaker_id');
    }

    public function Sponsors(){
        return $this->belongsToMany('App\Sponsor', 'sponsring_events', 'event_id', 'sponsor_id');
    }
    public function gallery() {
        return $this->hasMany('App\EventPhoto', 'event_id');
    }
    public function cover() {
        return $this->belongsTo('App\EventPhoto', 'cover_id');
    }  
    public function questions() {
        return $this->hasMany('App\QuestionEvent', 'event_id');
    }
    public function enrolled($user_id) {
        $user = \App\User::find($user_id);
        if ($user->type != 1)
            return false;
        $result = DB::table('enrollment_in_events')->where('event_id',$this->id)->where('guest_id',$user->userInfo->id)->first();
        return $result != null;
    }
    public function rates(){
        return $this->hasMany('App\EventRate', 'event_id');
    }
    public function totalRate(){
        return $this->rates->avg('rate');
    }
    public function isGuestRate($user_id){
        $user = \App\User::find($user_id);
        if ($user->type != 1)
            return false;
        $result = DB::table('events_rate')->where('event_id',$this->id)->where('guest_id',$user->userInfo->id)->first();
        return $result != null;
    }
    public function guestRate($user_id){
        $user = \App\User::find($user_id);
        if ($user->type != 1)
            return 0;
        $result = DB::table('events_rate')->where('event_id',$this->id)->where('guest_id',$user->userInfo->id)->first();
        return $result->rate;
    }
}
