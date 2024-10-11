@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('新規登録確認画面') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register.store') }}">
                        @csrf
                        
                        <div class="mb-3">
                            <label>名前</label>
                            <p>{{ $data['name'] }}</p>
                        </div>

                        <div class="mb-3">
                            <label>メールアドレス</label>
                            <p>{{ $data['email'] }}</p>
                        </div>

                        <div class="mb-3">
                            <label>パスワード</label>
                            <p>********</p> <!-- パスワードは表示しない -->
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('signup') }}" class="btn btn-secondary">戻る</a>
                            <button type="submit" class="btn btn-primary">登録</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
