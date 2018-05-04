<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommitteeShortcut extends Model
{
    // Table name
    protected $table = 'committees_codes';
    // Primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = false;

    public function committee(){
        return $this->hasMany('App\Committee', 'shortcut_id');
    }
}
