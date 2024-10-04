@extends('layouts.app')

@section('title', $user->name . 'のページ')

@section('content')
    <div class="container">
        <!-- ユーザー情報 -->
        <div class="row mb-3">
            <div class="col-md-4">
                <h2>{{ $user->name }}</h2>
                <p>{{ $user->profile }}</p> <!-- プロフィールを表示 -->
            </div>
            <div class="col-md-4 text-center">
                <!-- 中央部分は空白のまま -->
            </div>
            <div class="col-md-4 text-end">
                <!-- 編集ボタンは非表示に -->
            </div>
        </div>

        <!-- 投稿一覧 -->
        <div class="row">
            @foreach ($posts as $post)
                <div class="col-md-4 mb-3">
                    <a href="{{ url('/post_detail', $post->id) }}" class="card-link">
                        <div class="card hover-card w-100">
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p class="card-text">{{ $post->episode }}</p>
                                <p class="card-text">
                                    <small class="text-muted">投稿日時: {{ $post->created_at }}</small>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
