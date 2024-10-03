<?php  
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;
use App\Report;
use App\Like;
use App\Comment;


class RegistrationController extends Controller
{
    


    // 新規投稿を保存するメソッド
    public function storePost(Request $request)
    {
        // バリデーション
        $request->validate([
            'title' => 'required|max:30',
            'episode' => 'nullable',
            'image' => 'nullable|image',
        ]);

        // 画像のアップロード処理
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        // データベースに投稿を保存
        Post::create([
             'user_id' => auth()->id(), // ログイン中のユーザーIDを保存
            'title' => $request->input('title'),
            'episode' => $request->input('episode'),
            'image' => $imagePath,
            'date' => now(),
            'del_flag' => false,
        ]);

        // リダイレクトして完了メッセージを表示
        return redirect('/main')->with('success', '投稿が完了しました！');
    }

    public function showMypage()
    {
        // 現在ログインしているユーザーの情報を取得
        $user = Auth::user();

// 投稿を作成日で降順に並び替えて取得（古いものが後ろ）
$posts = Post::where('user_id', $user->id)
             ->where('del_flag', false)
             ->orderBy('created_at', 'desc') // 投稿日時で降順にソート
             ->get();

// ビューにユーザー情報と投稿データを渡す
return view('mypage', compact('user', 'posts'));

      
    }
    public function edit()
    {
        $user = Auth::user(); // ログインユーザー情報を取得
        return view('user_edit', compact('user'));
    }

    

    // ユーザー情報を更新
    public function update(Request $request)
    {
        $user = Auth::user();

        // バリデーション
        $request->validate([
            'name' => 'required|string|max:255',
            'profile' => 'nullable|string|max:1000', // 自己紹介は任意
        ]);

        // ユーザー情報を更新
        $user->name = $request->input('name');
        $user->prfile = $request->input('profile'); // 'prfile'はデータベースのカラム名に合わせる
        $user->save();

        return redirect()->route('mypage')->with('success', 'ユーザー情報が更新されました。');
    }

    public function showPost($id)
{
    // 指定されたIDの投稿を取得
    $post = Post::find($id);

    // もし投稿が見つからない場合は404エラーページを表示
    if (!$post) {
        abort(404, '投稿が見つかりません');
    }

    // 投稿詳細ページへ渡す
    return view('my_post', compact('post'));
}

public function showPostDetail($id)
{
    $post = Post::findOrFail($id);
    
    return view('post_detail', compact('post'));

}

public function deletePost($id)
{
    // 投稿をIDで取得
    $post = Post::find($id);

    // 投稿が存在しない場合は404エラー
    if (!$post) {
        abort(404, '投稿が見つかりません');
    }

    // del_flagを1に設定して論理削除
    $post->del_flag = 1;
    $post->save();

    // 削除完了後にリダイレクト
    return redirect('/mypage')->with('success', '投稿が削除されました');
}
// 報告フォームを表示するメソッド
public function showReportForm($postId)
{
    // 投稿をIDで取得
    $post = Post::findOrFail($postId);

    // 違反報告ページを表示
    return view('violationReport', compact('post'));
}

// 報告内容を保存するメソッド
public function submitReport(Request $request, $postId)
{
    // バリデーション
    $request->validate([
        'reason_type' => 'required|string|max:255',
    ]);

    // レポート作成
    Report::create([
        'user_id' => Auth::id(), // 現在のユーザーID
        'post_id' => $postId,    // 報告対象の投稿ID
        'reason_type' => $request->input('reason_type'), // 報告理由
    ]);

    // メインページにリダイレクト
    return redirect('/main')->with('success', '報告が送信されました。');
}

public function showPostEpisodeForm()
{
    // 現在ログインしているユーザーを取得
    $user = Auth::user();
    
    // ユーザー情報をビューに渡して表示
    return view('post_episode', compact('user'));
}

// いいねの処理
public function likePost(Request $request, Post $post)
{
    // すでに「いいね」しているか確認
    $existingLike = Like::where('user_id', Auth::id())
        ->where('post_id', $post->id)
        ->first();

    if ($existingLike) {
        // 既存の「いいね」を削除
        $existingLike->delete();
        return back()->with('message', 'いいねを取り消しました');
    } else {
        // 新しい「いいね」を追加
        Like::create([
            'user_id' => Auth::id(),
            'post_id' => $post->id,
        ]);

        return back()->with('message', 'いいねしました');
    }
}
 // コメントの処理
 public function addComment(Request $request, Post $post)
{
    // コメントのバリデーション
    $request->validate([
        'content' => 'required|max:500',  // 'content'フィールドのバリデーション
    ]);

    // dd($request->input('content'));

    // コメントを作成し、データベースに保存
    Comment::create([
        'user_id' => Auth::id(),             // ユーザーIDを保存
        'post_id' => $post->id,              // 投稿IDを保存
        'text' => $request->input('content') // contentフィールドの内容をtextカラムに保存
    ]);

    return back()->with('message', 'コメントを追加しました');
}
public function showLikedPosts()
{
    // ログインしているユーザーが「いいね」した投稿を取得
    $likedPosts = Auth::user()->likes->pluck('post');
    
    return view('footprint_list', ['likedPosts' => $likedPosts]);
}


public function likedPosts()
{
    $user = Auth::user();  // 現在ログインしているユーザーを取得
    $likedPosts = $user->likes()->with('post')->get();  // ユーザーが「いいね」した投稿を取得

    return view('liked_posts', compact('likedPosts'));
}



// app/Http/Controllers/PostController.php
public function search(Request $request)
{
    // ユーザー検索
    $userQuery = $request->input('user');
    // 投稿検索
    $postQuery = $request->input('post');
    // 日付検索
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    // 検索クエリを組み立てる
    $query = Post::query();

    // ユーザー名で検索する
    if ($userQuery) {
        $query->whereHas('user', function($q) use ($userQuery) {
            $q->where('name', 'like', "%{$userQuery}%");
        });
    }

    // 投稿のタイトルやエピソードで検索する
    if ($postQuery) {
        $query->where(function ($q) use ($postQuery) {
            $q->where('title', 'like', "%{$postQuery}%")
              ->orWhere('episode', 'like', "%{$postQuery}%");
        });
    }

    // 日付範囲が指定されている場合にフィルタリング
    if ($startDate && $endDate) {
        $query->whereBetween('created_at', [$startDate, $endDate]);
    }

    // 検索結果を新しい順に並べる
    $query->orderBy('created_at', 'desc');

    // 検索結果を取得
    $posts = $query->get();

    // 結果をビューに渡す
    return view('main', ['posts' => $posts]);
}







}

    

