<?php

namespace App\Http\Controllers;

use App\Quiz;
use Illuminate\Http\Request;
use App\Question;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $questions = Question::latest()->withCorrectAnswer()->paginate(20);
        return view('questions.index',compact('questions'));
    }

    public function create()
    {
        return view('questions.create');
    }

    public function store(Request $request)
    {
        $this->validator($request);
        $body = (object)['question' => $request->question, 'code'=> $request->code];
        $question = Question::create([
            'question' => json_encode($body),
            'points' => $request->points,
            'category_id' => $request->category_id,
            'question_type_id' => $request->type_id
        ]);

        foreach ($request->answers as $index=>$answer)
        {
            $question->addAnswer($answer, $index+1 == $request->correct);
        }

    }

    public function edit(Question $question)
    {
        $question = $question->load('answers');
        return view('questions.edit',compact('question'));
    }

    public function update(Request $request,Question $question)
    {
        $this->validator($request);
        $body = (object)['question' => $request->question, 'code'=> $request->code];
        $question = tap($question)->update([
            'question' => json_encode($body),
            'points' => $request->points,
            'category_id' => $request->category_id,
            'question_type_id' => $request->type_id
        ]);
        $question->answers()->delete();
        foreach ($request->answers as $index=>$answer)
        {
            $question->addAnswer($answer, $index+1 == $request->correct);
        }
    }

    public function destroy(Question $question)
    {
        $question->delete();
    }

    public function destroyAll()
    {
        DB::table('question')->delete();
        return back();
    }



    public function validator(Request $request)
    {
        return $request->validate([
            'question' => 'required',
            'code' => 'nullable',
            'points' => 'required|numeric',
            'correct' => 'required',
            'answers.*'=>'required'
        ],[
            'answers.*.required' => 'Invalid answers values'
        ]);
    }
}
