<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Answer;

class Question extends Model
{
    protected $table = 'question';
    protected $guarded = [];

    public static function boot()
    {
        parent::boot();
        static::deleting(function($question){
            $question->answers()->delete();
        });
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function quizzes()
    {
        return $this->belongsToMany(Quiz::class,'quiz_questions','question_id',
            'quiz_id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function getBodyAttribute()
    {
        return new QuestionBody($this->question);
    }

    public function addAnswer($answer,$isCorrect)
    {
        $this->answers()->create([
            'answer' => $answer,
            'is_correct' => $isCorrect
        ]);
    }

    public function correctAnswer()
    {
        return $this->answers()->where('is_correct',1)->first();
    }

    public function scopeWithCorrectAnswer($query)
    {
        return $query->leftJoin('answers','question.id','=','answers.question_id')
            ->selectRaw('question.*,answers.answer')
            ->whereRaw('answers.is_correct = TRUE');
    }

    public function isCorrectAnswer($answer)
    {
        return $this->correctAnswer()->id == $answer;
    }

}
