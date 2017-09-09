@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8 margin-bottom">
                <a href="{{url('/questions/create')}}" class="btn btn-primary">Create New Questions</a>
                @if(count($questions->items)>0)
                    <button class="btn btn-danger" id="delete-all">Delete All</button>
                    <form action="{{ url('/questions') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>
                @endif
            </div>
        </div>
        <questions  j-questions="{{json_encode($questions->items())}}"></questions>
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                {{$questions->links()}}
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#delete-all').on('click',function(e){
            e.preventDefault();
            swal({
                title: "Are you sure?",
                icon: "warning",
                buttons: {
                    cancel: true,
                    confirm: "Yes Delete All Questions"
                },
                dangerMode: true,
            }).then(() => {
                $('form').submit();
            });
        })
    </script>
@endsection