<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HIH extends Model
{
    // Table name
    protected $table = 'hih';
    // Primary key
    public $primaryKey = null;
    // Timestamps
    public $timestamps = false;

    public function president() {
        return $this->belongsTo('App\Member', 'president_id');
    }
}
