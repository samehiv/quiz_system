<?php

namespace App\Http\Controllers;

use App\Quiz;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->except('store','show');
    }

    public function index(Quiz $quiz)
    {
        $results = $quiz->results()->paginate(20);
        return view('results.index',compact('quiz','results'));
    }

    public function store(Request $request, Quiz $quiz)
    {
        $this->authorize('take-quiz',$quiz);
        $quiz->submit($request);
        return redirect('/results/'.$quiz->id);
    }

    public function show(Quiz $quiz)
    {
        $result = $quiz->getResult();
        return view('results.show',compact('quiz','result'));
    }

    public function destroyAll(Quiz $quiz)
    {
        $quiz->users()->sync([]);
        return back();
    }
}
