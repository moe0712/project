<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>違反報告</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* 全体の高さを調整 */
        html, body {
            height: 100%;
        }

        /* メインコンテンツを中央に配置 */
        .content-wrapper {
            min-height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center; /* 横方向の中央寄せ */
        }

        /* フォームの幅を調整 */
        .report-form {
            width: 100%;
            max-width: 600px; /* フォームの最大幅を600pxに制限 */
            margin: 0 auto;
        }

        /* フッターをページの下部に固定 */
        footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 60px;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <!-- ヘッダー -->
    <header class="bg-light p-3 border-bottom mb-4">
        <div class="container">
            <h2 class="text-center">違反報告</h2>
        </div>
    </header>

    <!-- コンテンツ -->
    <div class="content-wrapper container">
        <form action="{{ url('/submit_report', $post->id) }}" method="POST" class="report-form">
            @csrf
            <div class="mb-3">
                <label for="reason_type" class="form-label">報告理由</label>
                <textarea class="form-control" id="reason_type" name="reason_type" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">送信</button>
        </form>
    </div>

   

    <!-- BootstrapのJS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
