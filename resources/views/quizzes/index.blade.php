@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8 margin-bottom">
                <a href="{{url('/quizzes/create')}}" class="btn btn-primary">Create New Quiz</a>
            </div>
        </div>
        @foreach($quizzes as $quiz)
            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="q-options-btns">
                                <a href="{{ url('quizzes/'.$quiz->id.'/results') }}"
                                   class="btn btn-success btn-sm">Results</a>
                                <a href="{{ url('quizzes/'.$quiz->id.'/questions') }}"
                                   class="btn btn-default btn-sm">Mange Questions</a>
                                <a href="{{url('quizzes/'.$quiz->id.'/edit')}}"
                                   class="btn btn-primary btn-sm">Edit</a>
                                <button class="btn btn-danger btn-sm delete">Delete</button>
                                <form action="{{ url('/quizzes/'.$quiz->id) }}" method="POST" style="display: none;">
                                    {{method_field('DELETE')}}
                                    {{csrf_field()}}
                                </form>
                            </div>
                            <h3>
                                {{$quiz->name}}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
@section('script')
    <script>
        $('.delete').on('click',function(e){
            e.preventDefault();
            swal({
                title: "Are you sure?",
                icon: "warning",
                buttons: {
                    cancel: true,
                    confirm: "Yes Delete this Quiz"
                },
                dangerMode: true,
            }).then(() => {
                $(this).siblings('form').submit();
            });
        })
    </script>
@endsection