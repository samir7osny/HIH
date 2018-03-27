<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
    public function inboxRequests() {
        return $this->hasMany('App\Request', 'receiver');
    }

    public function outboxTasks() {
        return $this->hasMany('App\Task', 'sender');
    }
    public function inboxTasks() {
        return $this->hasMany('App\Task', 'receiver');
    }

    public function outboxMessages() {
        return $this->hasMany('App\Message', 'sender');
    }
    public function inboxMessages() {
        return $this->hasMany('App\Message', 'receiver');
    }
}
