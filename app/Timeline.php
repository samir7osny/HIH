<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    // Table name
    protected $table = 'sessiontimeline';
    // Primary key
    public $primaryKey = 'workshop_id';
    // Timestamps
    public $timestamps = false;
}
