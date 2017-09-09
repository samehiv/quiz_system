<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'username','is_admin'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function quizzes()
    {
        return $this->belongsToMany(Quiz::class,'user_quizes','user_id',
            'quiz_id');
    }




}
