@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">いいねした投稿</h2>
    <div class="row">
        @foreach ($likedPosts as $like)
            <div class="col-md-4 mb-3">
                <a href="{{ url('/post_detail', $like->post->id) }}" class="card-link">
                    <div class="card hover-card w-100">
                        <div class="card-body">
                            <!-- 投稿者の名前を表示 -->
                            <h6 class="card-subtitle mb-2 text-muted">
                                投稿者: {{ $like->post->user->name }}
                            </h6>
                            <!-- 投稿のタイトルを表示 -->
                            <h5 class="card-title">{{ $like->post->title }}</h5>
                            <!-- 投稿のエピソード内容を表示 -->
                            <p class="card-text">{{ $like->post->episode }}</p>
                            <!-- 投稿日時を表示 -->
                            <p class="card-text">
                                <small class="text-muted">投稿日時: {{ $like->post->created_at->format('Y/m/d H:i:s') }}</small>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection
