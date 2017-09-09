@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h4>{{$quiz->name}} Results</h4>
                <button class="btn btn-danger margin-bottom" id="delete-all">Delete All</button>
                <form action="{{ url('/quizzes/'.$quiz->id.'/results') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                </form>
            </div>
        </div>
        @if(count($results->items()) > 0)
            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Rank</th>
                            <th>Username</th>
                            <th>Points</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $skip = $results->currentPage() * $results->perPage() - $results->perPage();
                        @endphp
                        @foreach($results as $result)
                            <tr>
                                <td>
                                    {{$loop->iteration + $skip}}
                                </td>
                                <td>
                                    {{$result->username}}
                                </td>
                                <td>
                                    {{$result->pivot->result_points}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    {{$results->links()}}
                </div>
            </div>
        @endif
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
                    confirm: "Yes Delete All Results"
                },
                dangerMode: true,
            }).then(() => {
                $('form').submit();
            });
        })
    </script>
@endsection