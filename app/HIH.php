<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HIH extends Model
{
    // Table name
    protected $table = 'hih';
    // Primary key
    public $primaryKey = 'college_id';
    // Timestamps
    public $timestamps = false;

    public function president() {
        return $this->belongsTo('App\Member', 'president_id');
    }
    public function college() {
        return $this->belongsTo('App\College', 'college_id');
    }
    public function Sponsors(){
        return \App\HIHSponsors::all();
    }
}
