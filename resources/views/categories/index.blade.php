@extends('layouts.app')
@section('content')
    <div class="container">
        @foreach($categories as $category)
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-body" style="vertical-align: middle">
                            <h4>
                                <a href="{{$category->path()}}">{{$category->name}} Quizzes</a>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
