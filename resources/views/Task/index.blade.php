@extends('layouts.app')

@section('content')
@if(\Auth::check())
    <h1>タスク一覧</h1>
    @if (count($tasklist) > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>タイトル</th>
                        <th>タスク</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasklist as $tasklist)
                    <tr>
                    <td>{!! link_to_route('task.show', $tasklist->id, ['task'=>$tasklist->id]) !!}</td>
                    <td>{{ $tasklist->title }}</td>
                    <td>{{ $tasklist->content }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        {!! link_to_route('task.create', '新規タスクの追加', [], ['class' => 'btn btn-primary']) !!}
@else
<div class="center jumbotron">
        <div class="text-center">
            <h1>ようこそ Tasklistサイトへ</h1>
            {!! link_to_route('signup.get', 'Sign up now!', [], ['class' => 'btn btn-lg btn-primary']) !!}
        </div>
    </div>
@endif
@endsection
