@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h3>{{$category->name}} Quizzes</h3>
            </div>
        </div>
        @foreach($category->quizzes as $quiz)
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h4>
                                @can('take-quiz',$quiz)
                                <a href="{{ url('/quizzes/'.$quiz->id) }}">
                                    {{$quiz->name}}
                                </a>
                                @else
                                    {{$quiz->name}}
                                @endcan
                            </h4>
                            <div class="mata">
                                <div>
                                    {{$quiz->time}} minutes
                                </div>
                                <div>
                                    {{$quiz->questions->count()}} questions
                                </div>
                                @cannot('take-quiz',$quiz)
                                    <div>
                                        You got {{$quiz->getResult()->result_points}} points
                                            of {{$quiz->total_points}} points
                                    </div>
                                @endcannot
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection