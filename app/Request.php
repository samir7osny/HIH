<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    // Table name
    protected $table = 'deleting_request';
    // Primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    public function userSender() {
        return $this->belongsTo('App\User', 'sender');
    }

    public function userToDelete() {
        return $this->belongsTo('App\User', 'member_to_delete_id');
    }
}
