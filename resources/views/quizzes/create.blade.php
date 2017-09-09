@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Add New Quiz
                    </div>
                    <div class="panel-body">
                        @include('quizzes.quiz_form',['quiz'=>null])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection