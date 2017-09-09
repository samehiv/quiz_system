<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quiz;
use App\Question;

class QuizQuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index(Quiz $quiz)
    {
        $questions = $quiz->questions()->withCorrectAnswer()->paginate(20);
        return view('quizzes.questions',compact('quiz','questions'));
    }

    public function store(Quiz $quiz)
    {
        $quiz->addQuestion(request('id'));
    }

    public function create(Quiz $quiz)
    {
        $quizQuestions = $quiz->questions->pluck('id')->all();
        $questions = Question::whereNotIn('id',$quizQuestions)->paginate(20);
        return view('quizzes.add_questions',compact('quiz','questions'));
    }

    public function destroy(Quiz $quiz, $question)
    {
        $quiz->removeQuestion($question);
    }
}
