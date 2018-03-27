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
}
