<!-- resources/views/auth/passwords/reset.blade.php -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスワード再設定</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 300px;
            text-align: center;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>パスワード再設定</h2>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- トークン（リセットリンクに含まれる） -->
            <input type="hidden" name="token" value="{{ $token }}">
            
            <!-- メールアドレス -->
            <input type="email" name="email" value="{{ $email ?? old('email') }}" placeholder="メールアドレス" required autofocus>
            
            <!-- 新しいパスワード -->
            <input type="password" name="password" placeholder="新しいパスワードを入力" required>
            
            <!-- 新しいパスワード確認 -->
            <input type="password" name="password_confirmation" placeholder="新しいパスワードを確認入力" required>
            
            <button type="submit">登録</button>
        </form>
    </div>
</body>
</html>
