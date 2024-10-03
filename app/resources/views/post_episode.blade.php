@extends('layouts.app')

@section('title', '新規投稿エピソード登録ページ')

@section('content')
    <!-- メインコンテンツ -->
    <div class="container">
        <div class="row mb-3">
            <!-- ユーザーネーム表示 -->
            <div class="col-md-8">
                <h2>{{ $user->name }}</h2>
            </div>
        </div>

        <!-- 投稿フォーム -->
        <div class="row mb-3">
            <div class="col-12">
                <form action="/post_episode" method="POST" enctype="multipart/form-data">
                    @csrf <!-- CSRF保護トークン -->
                    <!-- タイトル入力 -->
                    <div class="mb-3">
                        <label for="title" class="form-label">タイトル</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <!-- 本文 -->
                    <div class="mb-3">
                        <textarea class="form-control" name="episode" rows="10" placeholder="ここに本文"></textarea>
                    </div>

                    <!-- 画像アップロード (必要であれば追加) -->
                    <div class="mb-3">
                        <label for="image" class="form-label">画像をアップロード</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>

                    <!-- POSTボタン -->
                    <div class="d-flex justify-content-center mt-4">
                        <button type="submit" class="btn btn-outline-primary btn-lg">POST</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
