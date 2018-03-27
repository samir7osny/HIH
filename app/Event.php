<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    // Table name
    protected $table = 'event';
    // Primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = false;
}
