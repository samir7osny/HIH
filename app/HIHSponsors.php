<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HIHSponsors extends Model
{
    // Table name
    protected $table = 'hih_sponsors';
    // Primary key
    public $primaryKey = 'sponsor_id';
    // Timestamps
    public $timestamps = false;

    public function sponsor() {
        return $this->belongsTo('App\Sponsor', 'sponsor_id');
    }
}
