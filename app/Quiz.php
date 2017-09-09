<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Quiz extends Model
{
    protected $table = 'quizes';
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class,'quiz_questions', 'quiz_id',
            'question_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'user_quizes','quiz_id',
            'user_id');
    }

    public function addQuestion($questionId)
    {
        $this->questions()->attach($questionId);
    }

    public function removeQuestion($questionId)
    {
        $this->questions()->detach($questionId);
    }

    public function isPass($points)
    {
        return $points >= $this->pass_points;
    }

    public function submit($request)
    {
        $points = 0;
        foreach ($this->questions as $question)
        {
            if($question->isCorrectAnswer($request->input($question->id)))
            {
                $points += $question->points;
            }
        }
        $this->users()->attach(auth()->id(),[
            'result_points' => $points,
            'result_state' => $this->isPass($points)?'pass':'not pass'
        ]);
    }

    public function getResult()
    {
        return $this->users()->withPivot('result_points','result_state')
            ->find(auth()->id())->pivot;
    }

    public function results()
    {
        return $this->users()->withPivot('result_points')
                ->orderBy('result_points','desc');
    }

}
