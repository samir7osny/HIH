<?php

namespace App;

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

    public function outboxRequests() {//One to many relationship
        return $this->hasMany('App\Request', 'sender');
    }

    public function deletingRequest() {//One to One relationship
        return $this->hasOne('App\Request', 'member_to_delete_id');
    }

    public function outboxTasks() {//One to many relationship
        return $this->hasMany('App\Task', 'sender');
    }
    public function inboxTasks() {//One to many relationship
        return $this->hasMany('App\Task', 'receiver');
    }

    public function college() {//One to One relationship
        return $this->belongsTo('App\College', 'college_id');
    }

    public function outboxMessages() {//One to many relationship
        return $this->hasMany('App\Message', 'sender');
    }
    public function inboxMessages() {//One to many relationship
        return $this->hasMany('App\Message', 'receiver');
    }
    public function userInfo() {//One to one relationship
        if ($this->type == 0) {     // for member
            return $this->belongsTo('App\Member', 'id_of');
        } else if ($this->type == 1) {  //for guest
            return $this->belongsTo('App\Guest', 'id_of');
        }
    }
}
