<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswerWorkshop extends Model
{
    // Table name
    protected $table = 'answers_workshops';
    // Primary key
    public $primaryKey = 'guest_id';
    // Timestamps
    public $timestamps = false;

    public function question() {
        return $this->belongsTo('App\QuestionWorkshop', 'question_id');
    }
    public function owner() {
        return $this->belongsTo('App\Guest', 'guest_id');
    }
}
