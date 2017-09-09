<form method="POST" action="{{$quiz !== null? '/quizzes/'.$quiz->id: '/quizzes'}}">
    {{csrf_field()}}
    @if($quiz !== null)
        {{method_field('PATCH')}}
    @endif
    <div class="form-group {{$errors->has('name')?'has-error':''}}">
        <label for="name">Name:</label>
        <input class="form-control" id="name" name="name" value="{{$quiz !== null? $quiz->name: old('name')}}" required>
        <span class="help-block">
            @if ($errors->has('name'))
                <span class="help-block">
                    {{ $errors->first('name') }}
                </span>
            @endif
        </span>
    </div>
    <div class="form-group {{$errors->has('time')?'has-error':''}}">
        <label for="time">Time in Minutes:</label>
        <input class="form-control" id="time" name="time" value="{{$quiz !== null? $quiz->time: old('time')}}" required>
        <span class="help-block">
            @if ($errors->has('time'))
                <span class="help-block">
                    {{ $errors->first('time') }}
                </span>
            @endif
        </span>
    </div>
    <div class="form-group {{$errors->has('total_points')?'has-error':''}}">
        <label for="total-points">Total Points:</label>
        <input class="form-control" id="total-points" name="total_points"
               value="{{$quiz !== null? $quiz->total_points: old('total_points')}}" required>
        <span class="help-block">
            @if ($errors->has('total_points'))
                <span class="help-block">
                    {{ $errors->first('total_points') }}
                </span>
            @endif
        </span>
    </div>
    <div class="form-group {{$errors->has('pass_points')?'has-error':''}}">
        <label for="pass-points">Pass Points:</label>
        <input class="form-control" id="pass-points" name="pass_points"
               value="{{$quiz !== null? $quiz->pass_points: old('pass_points')}}" required>
        <span class="help-block">
            @if ($errors->has('pass_points'))
                <span class="help-block">
                    {{ $errors->first('pass_points') }}
                </span>
            @endif
        </span>
    </div>
    <div class="form-group {{$errors->has('category_id')?'has-error':''}}">
        <label for="category-id">Category:</label>
        <select class="form-control" id="category-id" name="category_id">
            <option value="1" {{$quiz !== null && $quiz->category_id ===1?'selected':''}}>PHP</option>
            <option value="2" {{$quiz !== null && $quiz->category_id ===2?'selected':''}}>Java SE</option>
            <option value="3" {{$quiz !== null && $quiz->category_id ===3?'selected':''}}>MySQL</option>
            <option value="4" {{$quiz !== null && $quiz->category_id ===4?'selected':''}}>Python</option>
        </select>
        <span class="help-block">
            @if ($errors->has('category_id'))
                <span class="help-block">
                    {{ $errors->first('category_id') }}
                </span>
            @endif
        </span>
    </div>
    <button class="btn btn-primary">
        {{$quiz !== null? 'Update':'Create'}}
    </button>
</form>