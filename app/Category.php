<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'lkp_category';
    protected $guarded = [];

    public function path()
    {
        return '/categories/'.$this->id;
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function addQuiz($attributes)
    {
        $this->quizzes()->create($attributes);
    }
}
