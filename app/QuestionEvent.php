<?php

namespace App;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;

class QuestionEvent extends Model
{
    // Table name
    protected $table = 'questions_events';
    // Primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = false;

    public function event() {
        return $this->belongsTo('App\Event', 'event_id');
    }
    public function answers() {
        return $this->hasMany('App\AnswerEvent', 'question_id');
    }
    public function answer($user_id) {
        $answer = DB::table('answers_events')->where('question_id',$this->id)->where('guest_id',$user_id)->pluck('answer_content');
        return $answer->first();
    }
}
