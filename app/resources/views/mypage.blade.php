@extends('layouts.app')

@section('title', 'マイページ')

@section('content')
    <div class="container">
        <!-- ユーザー情報 -->
        <div class="row mb-3">
            <div class="col-md-4">
                <h2>{{ $user->name }}</h2>
                <p>{{ $user->prfile }}</p> <!-- プロフィールを表示 -->
                <button class="btn btn-outline-secondary" onclick="window.location.href='{{ route('liked_posts') }}'">
                    いいねした投稿
                </button>
            </div>
            <div class="col-md-4 text-center">
                <!-- 中央部分は空白で保持 -->
            </div>
            <div class="col-md-4 text-end">
                <!-- ヘッダーのユーザー情報編集ボタン -->
                <a href="{{ url('/user_edit') }}" class="btn btn-light profile-edit-btn">ユーザー情報編集</a>
            </div>
        </div>

        <!-- 投稿一覧 -->
        <div class="row">
            @foreach ($posts as $post)
                <div class="col-md-4 mb-3">
                    <a href="{{ url('/my_post', $post->id) }}" class="card-link">
                        <div class="card hover-card w-100">
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p class="card-text">{{ $post->episode }}</p>
                                <p class="card-text">
                                    <small class="text-muted">投稿日時: {{ $post->created_at }}</small>
                                </p>
                                 <!-- 画像のサムネイルを右下に表示 -->
                        @if ($post->image)
                            <div style="float: right; width: 60px; height: 60px; margin-left: 10px; margin-bottom: 10px; border: 1px solid #ddd; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                                <img src="{{ asset('storage/' . $post->image) }}" style="width: 100%; height: 100%; object-fit: cover;" alt="投稿画像">
                            </div>
                        @endif
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
