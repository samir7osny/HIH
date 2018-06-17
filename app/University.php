<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    // Table name
    protected $table = 'university';
    // Primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = false;

    public function colleges() {
        return $this->hasMany('App\College', 'university_id');
    }
}
