<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkshopPhoto extends Model
{
    // Table name
    protected $table = 'workshop_gallary';
    // Primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = false;

    public function workshop() {
        return $this->belongsTo('App\Workshop', 'workshop_id');
    }
}
