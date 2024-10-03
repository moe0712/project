<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投稿詳細</title>
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

.footer-btn i, .footer-btn span {
    font-size: 40px;  
    margin-right: 8px;
}

.footer-btn:hover {
    color: #898989;
}

.profile-edit-btn {
    font-size: 1rem; /* 通常のボタンサイズに戻す */
    padding: 8px 16px;
    margin-top: 10px;
}
.center-card {
    max-width: 600px;
    margin: 0 auto;
    margin-top: 100px;
    position: relative;
}
.report-btn {
    position: absolute;
    top: 10px;
    right: 10px;
}
.card {
    min-height: 200px;
}
.like-comment {
    display: flex;
    align-items: center;
}
.like-comment i {
    margin-right: 5px;
}
.favorite-icon {
    color: grey; 
}

.favorite-icon.active {
    color: red; 
}
.like-count, .like-count a {
    text-decoration: none !important;  /* 下線を強制的に削除 */
    color: inherit !important;  /* 親要素から色を継承 */
}

button, .btn-link {
    border: none;
    background: none;
    padding: 0;
    margin: 0;
    color: inherit;
    text-decoration: none !important;  /* ボタン内の下線を削除 */
    cursor: pointer;
}

.like-comment {
    display: flex;
    align-items: center;
}

.like-comment i {
    margin-right: 5px;
}

button {
    border: none;
    background: none;
    padding: 0;
    cursor: pointer;
}

/* コメントセクションのスタイル */
.comment-section {
    display: none;  /* 最初は非表示 */
    margin-top: 10px;
}
.comment-item {
    border-bottom: 1px solid #ddd;
    padding: 5px 0;
}
.header-content {
            position: relative;
            text-align: center;
        }

    </style>
</head>
<body>
    <!-- ヘッダー -->
    <header class="bg-light p-3 border-bottom mb-4">
    <div class="container d-flex justify-content-between align-items-center">
        <a href="javascript:history.back()" class="btn btn-outline-secondary back-btn">戻る</a>
        <h2 class="header-title mx-auto text-center">投稿詳細</h2>
    </div>
</header>


    <div class="container">
        <!-- 投稿の詳細ページ -->
<div class="card center-card">
    <div class="card-body">
    <p><strong>{{ $post->user->name }}</strong></p> 
        <h3>{{ $post->title }}</h3>
        <p>{{ $post->episode }}</p>
        <p class="text-muted">{{ $post->created_at->format('Y/m/d') }}</p>
      

        <!-- 画像があれば表示 -->
        @if ($post->image)
            <div class="mb-3">
                <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid" alt="投稿画像">
            </div>
        @endif

       <!-- いいね機能 -->
       <div class="like-comment mt-3">
            @if (Auth::check())
                <form action="{{ route('like.store', $post) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-link p-0">
                        <i class="material-icons-round favorite-icon {{ $post->likes->contains('user_id', Auth::id()) ? 'active' : '' }}">
                            {{ $post->likes->contains('user_id', Auth::id()) ? 'favorite' : 'favorite_border' }}
                        </i>
                        <!-- いいねのカウント表示 -->
                        <span class="like-count">{{ $post->likes->count() }}</span>
                    </button>
                </form>
            @endif
            <!-- コメントアイコン -->
            <button type="button" class="btn btn-link p-0 ms-4" onclick="toggleCommentSection({{ $post->id }})">
                <i class="material-icons-round">chat_bubble_outline</i> <!-- コメントアイコン -->
                <span class="comment-count">{{ $post->comments->count() }}</span>
            </button>
       </div>

        <!-- コメントセクション（最初は非表示） -->
        <div id="comment-section-{{ $post->id }}" class="comment-section">
            <!-- コメントフォーム -->
            <form action="{{ route('comment.store', $post) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <textarea name="content" class="form-control" rows="3" placeholder="コメントを追加"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">コメントを投稿</button>
            </form>

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

    <!-- フッター -->
    <footer class="bg-light py-3 mt-auto fixed-bottom">
        <div class="container">
        <div class="d-flex justify-content-around">
            <a href="{{ url('/main') }}" class="footer-btn">
                <span class="material-icons-round">home</span>
            </a>
            <a href="{{ url('/post_episode') }}" class="footer-btn">
                <span class="material-icons-round">add_circle</span>
            </a>
            <a href="{{ url('/mypage') }}" class="footer-btn">
                <span class="material-icons-round">person</span>
            </a>
        </div>
        </div>
    </footer>

    <!-- BootstrapのJSとアイコン -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleCommentSection(postId) {
            var section = document.getElementById('comment-section-' + postId);
            if (section.style.display === 'none' || section.style.display === '') {
                section.style.display = 'block';  // コメントセクションを表示
            } else {
                section.style.display = 'none';  // コメントセクションを非表示
            }
        }
    </script>

    
</body>
</html>
