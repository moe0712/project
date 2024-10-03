@extends('layouts.app')

@section('content')

<!-- 検索フォームを追加 -->
<form action="{{ route('search') }}" method="GET">
    <div class="search-box d-flex gap-2 mb-4">
        <input type="text" class="form-control" name="user" placeholder="ユーザー検索">
        <input type="text" class="form-control" name="post" placeholder="投稿検索">
        <input type="date" class="form-control" name="start_date" placeholder="開始日">
        <span class="align-self-center">〜</span>
        <input type="date" class="form-control" name="end_date" placeholder="終了日">
        <button type="submit" class="btn btn-primary">検索</button>
    </div>
</form>



<!-- 投稿リスト -->
<div class="row">
    @foreach ($posts as $post)
        <div class="col-md-4 mb-3">
            @if ($post->user_id == Auth::user()->id)
                <a href="{{ url('/my_post', $post->id) }}" class="card-link">
            @else
                <a href="{{ url('/post_detail', $post->id) }}" class="card-link">
            @endif
                <div class="card hover-card w-100">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">
                            投稿者: {{ $post->user->name }}
                        </h6>
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ $post->episode }}</p>
                        <p class="card-text">
                            <small class="text-muted">投稿日時: {{ $post->created_at->format('Y/m/d') }}</small>
                        </p>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>

@endsection
