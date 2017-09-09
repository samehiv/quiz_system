<?php

namespace App\Http\Controllers;

use App\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->except('show');
    }

    public  function index()
    {
        $quizzes = Quiz::latest()->paginate(20);
        return view('quizzes.index',compact('quizzes'));
    }

    public function create()
    {
        return view('quizzes.create');
    }


    public function store(Request $request)
    {
        $data = $this->validator($request);
        Quiz::create($data);
        return redirect('/quizzes');
    }

    public function show(Quiz $quiz)
    {
        $this->authorize('take-quiz',$quiz);
        $questions = $quiz->questions()->with('answers')->get();
        return view('quizzes.show',compact('questions','quiz'));
    }

    public function edit(Quiz $quiz)
    {
        return view('quizzes.edit',compact('quiz'));
    }

    public function update(Request $request,Quiz $quiz)
    {
        $data = $this->validator($request);
        $quiz->update($data);
        return redirect('/quizzes');
    }



    public function validator(Request $request)
    {
        return $request->validate([
            'name' => 'required',
            'time' => 'required|numeric',
            'pass_points' => 'required|numeric',
            'total_points' => 'required|numeric',
            'category_id' => 'required'
        ]);
    }
}
