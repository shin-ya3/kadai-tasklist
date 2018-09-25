@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <?php $user = Auth::user(); ?>
        <h1>タスクリスト一覧</h1>
    
        @if (count($tasks) > 0)
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th>id</th>
                    <th>項目</th>
                    <th>ステータス</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($tasks as $task)
                  <tr>
                    <td>{!! link_to_route('tasks.show', $task->id, ['id' => $task->id]) !!}</td>
                    <td>{{ $task->content }}</td>
                    <td>{{ $task->status}}</td>
                  </tr>
                  @endforeach
                </tbody>
            </table>
        @endif
        
        {!! link_to_route('tasks.create', '新規タスク作成',null, ['class' => 'btn btn-primary']) !!}
        
    @else
        <div class="center jumbotron">
            <div class="text-center">
                <h1>Welcome to the Microposts</h1>
                {!! link_to_route('signup.get', 'Sign up now!', null, ['class' => 'btn btn-lg btn-primary']) !!}
            </div>
        </div>
    @endif
        
        
@endsection