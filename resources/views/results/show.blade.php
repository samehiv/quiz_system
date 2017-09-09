@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{$quiz->name}} result:
                    </div>
                    <div class="panel-body text-center">
                        <h4>Total Quiz Points: {{$quiz->total_points}}</h4>
                        <h4>Pass Quiz Points: {{$quiz->pass_points}}</h4>
                        <h4>You Got {{$result->result_points}} Points</h4>
                        @if($result->result_state === 'pass')
                            <h4 class="text-success">{{$result->result_state}}</h4>
                        @else
                            <h4 class="text-danger">{{$result->result_state}}</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection