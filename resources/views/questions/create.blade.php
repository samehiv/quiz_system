@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create New Questions</div>
                    <div class="panel-body">
                        <create-question-form></create-question-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection