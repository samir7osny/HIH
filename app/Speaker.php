<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    // Table name
    protected $table = 'speaker';
    // Primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = false;
}
