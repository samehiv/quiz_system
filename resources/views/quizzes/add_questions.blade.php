@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h3>{{$quiz->name}}</h3>
            </div>
        </div>
        @foreach($questions as $question)
            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <add-to-quiz question-id="{{$question->id}}" quiz-Id="{{$quiz->id}}"></add-to-quiz>
                            <p>{{$question->body->question}}</p>
                            <h4>The Answer is: {{$question->correctAnswer()->answer}}</h4>
                            Points: {{$question->points}}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                {{$questions->links()}}
            </div>
        </div>
    </div>
@endsection