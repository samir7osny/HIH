<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    // Table name
    protected $table = 'request';
    // Primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;
}
