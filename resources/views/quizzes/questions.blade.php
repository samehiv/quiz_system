@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h3>{{$quiz->name}} questions</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <a href="{{ url('/quizzes/'.$quiz->id.'/questions/create') }}" class="btn btn-primary">Add Questions</a>
                <hr>
            </div>
        </div>
        @if(count($questions->items())>0)
            <quiz-questions quiz-id="{{$quiz->id}}" j-questions="{{json_encode($questions->items())}}"></quiz-questions>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    {{$questions->links()}}
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h4 class="text-center">this quiz not have any questions</h4>
                </div>
            </div>
        @endif

    </div>
@endsection
