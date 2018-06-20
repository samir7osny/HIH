<?php

namespace App;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;

class QuestionWorkshop extends Model
{
    // Table name
    protected $table = 'questions_workshops';
    // Primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = false;

    public function workshop() {
        return $this->belongsTo('App\Workshop', 'workshop_id');
    }
    public function answers() {
        return $this->hasMany('App\AnswerWorkshop', 'question_id');
    }
    public function answer($user_id) {
        $answer = DB::table('answers_workshops')->where('question_id',$this->id)->where('guest_id',$user_id)->pluck('answer_content');
        return $answer->first();
    }
}
