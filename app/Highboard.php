<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Highboard extends Model
{
    // Table name
    protected $table = 'highboards';
    // Primary key
    public $primaryKey = 'member_id';
    // Timestamps
    public $timestamps = false;

    public function memberInfo() {
        return $this->belongsTo('App\Member', 'member_id');
    }
}
