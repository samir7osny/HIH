<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    // Table name
    protected $table = 'college';
    // Primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = false;
    
}
