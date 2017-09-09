@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Question</div>
                    <div class="panel-body">
                        <edit-question-form j-question="{{json_encode($question)}}"></edit-question-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection