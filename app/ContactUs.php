<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    // Table name
    protected $table = 'contactus';
    // Primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;
}
