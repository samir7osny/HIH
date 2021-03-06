<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Committee extends Model
{
    // Table name
    protected $table = 'committee';
    // Primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = false;

    public function head() {
        return $this->belongsTo('App\Member', 'head_id');
    }

    public function members() {
        return $this->hasMany('App\Member', 'committee_id');
    }
    public function shortcut(){
        return $this->belongsTo('App\CommitteeShortcut', 'shortcut_id');
    }
}
