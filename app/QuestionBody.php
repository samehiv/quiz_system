<?php

namespace App;

class QuestionBody
{
    private $body;

    public function __construct($body)
    {
        $this->body = json_decode($body);
    }

    public function question()
    {
        return $this->body->question;
    }

    public function code()
    {
        return $this->body->id;
    }

    public function __get($property)
    {
        if(method_exists($this,$property))
        {
            return $this->{$property}();
        }
    }
}