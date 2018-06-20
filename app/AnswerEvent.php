<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswerEvent extends Model
{
    // Table name
    protected $table = 'answers_events';
    // Primary key
    public $primaryKey = 'guest_id';
    // Timestamps
    public $timestamps = false;

    public function question() {
        return $this->belongsTo('App\QuestionEvent', 'question_id');
    }
    public function owner() {
        return $this->belongsTo('App\Guest', 'guest_id');
    }
}
