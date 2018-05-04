<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // Table name
    protected $table = 'tasks';
    // Primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    public function userSender() {
        return $this->belongsTo('App\User', 'sender');
    }

    public function userReceiver() {
        return $this->belongsTo('App\User', 'receiver');
    }
}
