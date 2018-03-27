<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    // Table name
    protected $table = 'sponsor';
    // Primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = false;
}
