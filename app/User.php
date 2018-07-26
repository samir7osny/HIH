<?php

namespace App;
use Illuminate\Support\Facades\Auth;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    // Timestamps
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password','type','id_of','first_name', 'last_name', 'email', 'phone_number', 'photo_url','college_id','about'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function outboxRequests() {
        return $this->hasMany('App\Request', 'sender');
    }

    public function deletingRequest() {
        return $this->hasOne('App\Request', 'member_to_delete_id');
    }

    public function outboxTasks() {
        return $this->hasMany('App\Task', 'sender');
    }
    public function inboxTasks() {
        return $this->hasMany('App\Task', 'receiver');
    }

    public function college() {
        return $this->belongsTo('App\College', 'college_id');
    }

    public function outboxMessages() {
        return $this->hasMany('App\Message', 'sender');
    }
    public function inboxMessages() {
        return $this->hasMany('App\Message', 'receiver');
    }
    public function userInfo() {
        if ($this->type == 0) {     // for member
            return $this->belongsTo('App\Member', 'id_of');
        } else if ($this->type == 1) {
            return $this->belongsTo('App\Guest', 'id_of');
        }
    }


    public function isCommitteeHeadOf($committee_id){
        return (Auth::check() && Auth::user()->userInfo->headOf == $committee_id);
    }
    public function isCommitteeHead(){
        return (Auth::check() && Auth::user()->userInfo->headOf != null);
    }
    public function isPresident(){
        return ((Auth::check() && Auth::user()->userInfo->hihPresident != null) || (\App\User::count() == 1) );
    }
    public function isFRHead(){
        return (Auth::check() && Auth::user()->userInfo->headOf != null && Auth::user()->userInfo->headOf->shortcut->shortcut == 'FR');
    }
    public function isHRHead(){
        return (Auth::check() && Auth::user()->userInfo->headOf != null && Auth::user()->userInfo->headOf->shortcut->shortcut == 'HR');
    }
    public function isPRHead(){
        return (Auth::check() && Auth::user()->userInfo->headOf != null && Auth::user()->userInfo->headOf->shortcut->shortcut == 'PR');
    }
    public function isMarketingHead(){
        return (Auth::check() && Auth::user()->userInfo->headOf != null && Auth::user()->userInfo->headOf->shortcut->shortcut == 'MK');
    }
    public function isHRMember(){
        return (Auth::check() && Auth::user()->userInfo->committee != null && Auth::user()->userInfo->committee->shortcut->shortcut == 'HR');
    }
    public function isHighBoard(){
        return (Auth::check() && Auth::user()->userInfo->isHighboard());
    }

    static public function havePermission($params){
        $permission = false;
        foreach ($params as $key => $value) {
            if (    ($value == 'PRESIDENT' && Auth::check() && Auth::user()->userInfo->isMember() && Auth::user()->userInfo->hihPresident)
                ||  ($value == 'MEMBER' && Auth::check() && Auth::user()->userInfo->isMember())
                ||  ($value == 'GUEST' && Auth::check() && !Auth::user()->userInfo->isMember())
                ||  ($value == 'HIGHBOARD' && Auth::check() && Auth::user()->userInfo->isMember() && Auth::user()->userInfo->isHighboard())
                ||  ($value == 'BOARD' && Auth::check() && Auth::user()->userInfo->isMember() && Auth::user()->userInfo->headOf)
                ||  ($value == 'TYPE_HEAD' && Auth::check() && Auth::user()->userInfo->isMember() && Auth::user()->userInfo->headOf && Auth::user()->userInfo->headOf->shortcut->shortcut == $params[$key + 1])
                ||  ($value == 'TYPE_MEMBER' && Auth::check() && Auth::user()->userInfo->isMember() && Auth::user()->userInfo->committee && Auth::user()->userInfo->committee->shortcut->shortcut == $params[$key + 1])
                ||  ($value == 'COMMITTEE_HEAD' && Auth::check() && Auth::user()->userInfo->isMember() && Auth::user()->userInfo->headOf && Auth::user()->userInfo->headOf->id == $params[$key + 1])
                ||  ($value == 'EVENT_AUD' && Auth::check() && !Auth::user()->userInfo->isMember() && \App\EventEnrollment::where('event_id', $params[$key + 1])->where('guest_id', Auth::user()->userInfo->id)->first())
                ||  ($value == 'WORKSHOP_AUD' && Auth::check() && !Auth::user()->userInfo->isMember() && \App\WorkshopEnrollment::where('workshop_id', $params[$key + 1])->where('guest_id', Auth::user()->userInfo->id)->first())
                ||  ($value == 'TASK_HIGHBOARD' && Auth::check() && Auth::user()->userInfo->isMember() && Auth::user()->userInfo->isHighboard() && 
                    \App\User::find($params[$key + 1]) && \App\User::find($params[$key + 1])->userInfo->isMember() && !\App\User::find($params[$key + 1])->userInfo->isHighboard() && !\App\User::find($params[$key + 1])->userInfo->hihPresident)
                ||  ($value == 'TASK_BOARD' && Auth::check() && Auth::user()->userInfo->isMember() && Auth::user()->userInfo->headOf && 
                    \App\User::find($params[$key + 1]) && \App\User::find($params[$key + 1])->userInfo->isMember() && !\App\User::find($params[$key + 1])->userInfo->isHighboard() && !\App\User::find($params[$key + 1])->userInfo->hihPresident && !\App\User::find($params[$key + 1])->userInfo->headOf)
                ||  ($value == 'ANYONE')
                )
                $permission = true;
        }
        return $permission;
    }
}