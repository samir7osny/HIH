<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    // Table name
    protected $table = 'member';
    // Primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = false;
}
