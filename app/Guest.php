<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    // Table name
    protected $table = 'guest';
    // Primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = false;
}
