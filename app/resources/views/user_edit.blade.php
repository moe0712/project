@extends('layouts.app')

@section('title', 'ユーザー情報編集')

@section('content')
    <div class="container d-flex justify-content-center mt-5">
        <div class="col-md-6 p-5 border rounded shadow">
            <!-- 成功メッセージ表示 -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- アカウント削除ボタン -->
            <div class="text-end mb-4">
                <button type="button" class="btn btn-danger">アカウントを削除</button>
            </div>

            <!-- ユーザー情報編集フォーム -->
            <form action="{{ route('user.update') }}" method="POST">
                @csrf

                <!-- 名前入力 -->
                <div class="mb-4">
                    <label for="name" class="form-label">名前</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                </div>

                <!-- 自己紹介入力 -->
                <div class="mb-4">
                    <label for="profile" class="form-label">自己紹介</label>
                    <textarea class="form-control" id="prfile" name="profile" rows="5">{{ old('prfile', $user->prfile) }}</textarea>
                </div>

                <!-- キャンセルと保存ボタン -->
                <div class="d-flex justify-content-center">
                    <!-- キャンセルボタン -->
                    <a href="{{ route('mypage') }}" class="btn btn-outline-danger me-3">キャンセル</a>

                    <!-- 保存ボタン -->
                    <button type="submit" class="btn btn-primary">保存</button>
                </div>
            </form>
        </div>
    </div>
@endsection
