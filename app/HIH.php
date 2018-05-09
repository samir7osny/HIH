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

    public function president() {//One to One relationship
        return $this->belongsTo('App\Member', 'president_id');
    }
    public function college() {//One to One relationship
        return $this->belongsTo('App\College', 'college_id');
    }
}
