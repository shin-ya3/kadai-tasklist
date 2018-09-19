@extends('layouts.app')

@section('content')

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
    
@endsection