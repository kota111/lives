{{--ログイン済のユーザーかどうかをチェックする--}}
@if (Auth::check())
    {{-- ログイン済のユーザーがis_goingがtrueだったら--}}
    @if (Auth::user()->is_going($live->id))
        {{-- ungoingボタンのフォーム --}}
        {!! Form::open(['route' => ['ungoing', $live->id], 'method' => 'delete']) !!}
        {!! Form::submit('行ってなかった...', ['class' => "btn btn-danger btn-block"]) !!}
        {!! Form::close() !!}
        {{-- ログイン中のユーザーがis_goingがfalseだったら--}}
    @else
        {{-- goingーボタンのフォーム --}}
        {!! Form::open(['route' => ['going', $live->id]]) !!}
        {!! Form::submit('行った！', ['class' => "btn btn-primary btn-block"]) !!}
        {!! Form::close() !!}
    @endif
@endif
