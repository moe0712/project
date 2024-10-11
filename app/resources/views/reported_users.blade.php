@extends('layouts.app')

@section('content')
<div class="container">
    <h1>報告件数が多いユーザー</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>名前</th>
                <th>メールアドレス</th>
                <th>報告件数</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td><a href="{{ url('/user_page', $user->id) }}">{{ $user->name }}</a></td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->reports_count }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
