@extends('layouts.app')

@section('content')

    <h1>id = {{ $task->id }}のタスク詳細ページ</h1>
    
    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <th>ステータス</th>
            <th>項目</th>
            
        </tr>
        <tr>
            <td>{{ $task->id }}</td>
            <td>{{ $task->status }}</td>
            <td>{{ $task->content }}</td>
        </tr>
    </table>
    
    {!! link_to_route('tasks.edit', 'このタスクを編集', ['id' => $task->id], ['class' => 'btn btn-default']) !!}
    
    {!! Form::model($task, ['route' => ['tasks.destroy', $task->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

@endsection