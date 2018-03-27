<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    // Table name
    protected $table = 'request';
    // Primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    public function sender() {
        return $this->belongsTo('App\User', 'sender');
    }

    public function receiver() {
        return $this->belongsTo('App\User', 'receiver');
    }
}
