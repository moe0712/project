<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投稿詳細</title>
    <!-- BootstrapのCSSを読み込み -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <style>

.footer-btn {
        display: flex;
        align-items: center;
        font-size: 1.5rem;
        color: #595757;
        text-decoration: none;
    }

    .footer-btn i,
    .footer-btn span {
        font-size: 40px;
        margin-right: 8px;
    }

    .footer-btn:hover {
        color: #898989;
    }
        /* カードを中央に配置 */
        .center-card {
            max-width: 600px;
            margin: 0 auto;
            position: relative;
            margin-top: 100px;
        }

        /* 削除ボタンをカード内右上に配置 */
        .delete-btn {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        /* カードの高さを調整 */
        .card {
            min-height: 200px;
        }

        .like-comment {
            display: flex;
            align-items: center;
        }

        .like-comment i {
            margin-right: 5px;
            cursor: pointer;
        }

        /* ヘッダーの投稿詳細を中央に配置 */
        .header-content {
            position: relative;
            text-align: center;
        }

        /* 左端に戻るボタンを配置 */
        .back-btn {
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
        }

        .header-title {
            margin: 0;
        }

        /* コメントセクションのスタイル */
        .comment-section {
            display: none;  /* 初期状態では非表示 */
            margin-top: 10px;
        }

        .comment-item {
            border-bottom: 1px solid #ddd;
            padding: 5px 0;
        }
    </style>
</head>

<body>
    <!-- ヘッダー -->
    <header class="bg-light p-3 border-bottom mb-4">
        <div class="container header-content">
            <a href="javascript:history.back()" class="btn btn-outline-secondary back-btn">戻る</a>
            <h2 class="header-title">投稿詳細</h2>
        </div>
    </header>

    <div class="container">
        <!-- 投稿詳細を中央に配置 -->
        <div class="card mb-4 center-card">
            <div class="card-body">
                <!-- 削除ボタンをカード内右上に配置 -->
                <button type="button" class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal">
                    削除
                </button>
                <p><strong>{{ $post->user->name }}</strong></p> 
                <h3>{{ $post->title }}</h3>
                <p>{{ $post->episode }}</p>
                <p class="text-muted">{{ $post->created_at->format('Y/m/d') }}</p>
                

                <!-- 画像表示 -->
                @if ($post->image)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid" alt="投稿画像">
                    </div>
                @endif

                <!-- いいね＆コメント -->
                <div class="like-comment mt-3">
                    <!-- いいねアイコン：クリックでいいねしたユーザーを表示するモーダルを開く -->
                    <i class="material-icons-round" data-bs-toggle="modal" data-bs-target="#likeModal">favorite_border</i> 
                    <span>{{ $post->likes->count() }}</span>

                    <!-- コメントアイコン：クリックでコメントをトグル表示 -->
                    <i class="material-icons-round ms-4" onclick="toggleCommentSection()">chat_bubble_outline</i> 
                    <span>{{ $post->comments->count() }}</span>
                </div>

                <!-- コメントセクション -->
                <div id="comment-section" class="comment-section">
                    <!-- 既存のコメントを表示 -->
                    <div class="comments-list mt-3">
                        @foreach($post->comments as $comment)
                            <div class="comment-item">
                                <strong>{{ $comment->user->name }}:</strong> {{ $comment->text }}
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- いいねしたユーザーを表示するモーダル -->
    <div class="modal fade" id="likeModal" tabindex="-1" aria-labelledby="likeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="likeModalLabel">この投稿に「いいね」したユーザー</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        @foreach($post->likes as $like)
                            <li class="list-group-item">{{ $like->user->name }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                </div>
            </div>
        </div>
    </div>

    <!-- 削除確認モーダル -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">投稿削除確認</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    本当にこの投稿を削除しますか？
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
                    <form action="{{ url('/post_delete', $post->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">削除</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- フッター -->
    <footer class="bg-light py-3 mt-auto fixed-bottom">
        <div class="container">
            <div class="d-flex justify-content-around">
                <!-- ホームアイコン -->
                <a href="{{ url('/main') }}" class="footer-btn text-decoration-none">
                    <span class="material-icons-round">home</span>
                </a>
                <!-- 投稿アイコン -->
                <a href="{{ url('/post_episode') }}" class="footer-btn text-decoration-none">
                    <span class="material-icons-round">add_circle</span>
                </a>
                <!-- マイページアイコン -->
                <a href="{{ url('/mypage') }}" class="footer-btn text-decoration-none">
                    <span class="material-icons-round">person</span>
                </a>
            </div>
        </div>
    </footer>

    <!-- BootstrapのJSとアイコン -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleCommentSection() {
            var section = document.getElementById('comment-section');
            if (section.style.display === 'none' || section.style.display === '') {
                section.style.display = 'block';  // コメントセクションを表示
            } else {
                section.style.display = 'none';  // コメントセクションを非表示
            }
        }
    </script>
</body>

</html>
