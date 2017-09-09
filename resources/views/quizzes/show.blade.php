@extends('layouts.app')
@section('content')
    <quiz j-questions="{{json_encode($questions)}}" j-quiz="{{json_encode($quiz)}}"></quiz>
@endsection