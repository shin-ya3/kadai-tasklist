@extends('layouts.app')

@section('content')
     @if (Auth::check())
        <?php $user = Auth::user(); ?>
        タスクリスト一覧表示
    @else
        <div class="center jumbotron">
            <div class="text-center">
                <h1>Welcome to the Microposts</h1>
                {!! link_to_route('signup.get', 'Sign up now!', null, ['class' => 'btn btn-lg btn-primary']) !!}
            </div>
        </div>
    @endif
@endsection