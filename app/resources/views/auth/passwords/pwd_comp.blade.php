<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスワード再設定完了</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }
        .container {
            width: 50%;
            margin: 0 auto;
        }
        .header {
            background-color: #f8f9fa;
            padding: 10px;
            margin-bottom: 30px;
            font-size: 24px;
            font-weight: bold;
        }
        .content {
            font-size: 18px;
            margin-bottom: 20px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            border: 1px solid #000;
            text-decoration: none;
            color: #000;
        }
    </style>
</head>
<body>
    <div class="container">
        
        <div class="content">
            パスワード再設定が終わりました。
        </div>
        <a class="btn" href="{{ route('login') }}">ログイン画面へ</a>
    </div>
</body>
</html>
