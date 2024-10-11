<?php
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Http\Controllers\ForgotPasswordController;






// Laravelの認証ルート
Auth::routes();


// 新規登録画面のルート
Route::get('/signup', [RegisterController::class, 'showRegistrationForm'])->name('signup');

Route::post('/signup/confirm', [RegisterController::class, 'showConfirmation'])->name('signup.confirm');
Route::post('/signup/store', [RegisterController::class, 'store'])->name('signup.store');

// 管理者専用ページ
Route::get('/ownerpage', function () {
    return view('ownerpage');  // 管理者専用ページ
})->middleware(['auth', 'admin']);  // 'auth' と 'admin' ミドルウェアを適用

// 報告件数が多いユーザーを取得するルート
Route::get('/admin/reported-users', [AdminController::class, 'getReportedUsers'])->name('admin.getReportedUsers');



// パスワードリセットリンク要求フォーム
Route::get('password/reset/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');

Route::get('password/reset', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');


// メインページのルート
Route::get('/', [DisplayController::class, 'index'])->middleware('auth');  // 認証が必要なメインページ
Route::get('/main', [DisplayController::class, 'index'])->middleware('auth')->name('main'); 

// マイページのルート
Route::get('/mypage', [RegistrationController::class, 'showMypage'])->name('mypage')->middleware('auth');

// 投稿ページのルート
Route::get('/post_episode', function () {
    return view('post_episode');  // 'post_episode' ビューを表示
})->middleware('auth');

// 投稿フォーム送信処理
Route::post('/post_episode', [RegistrationController::class, 'storePost'])->name('post.store')->middleware('auth');

// ユーザー編集ページ
Route::get('/user_edit', [RegistrationController::class, 'edit'])->name('user.edit')->middleware('auth');
Route::post('/user_edit', [RegistrationController::class, 'update'])->name('user.update')->middleware('auth');

// 自分の投稿の詳細ページのルート
Route::get('/my_post/{id}', [RegistrationController::class, 'showPost'])->middleware('auth');

// 他の人の投稿の詳細ページのルート
Route::get('/post_detail/{id}', [RegistrationController::class, 'showPostDetail'])->middleware('auth');

// 倫理削除のルート
Route::delete('/post_delete/{id}', [RegistrationController::class, 'deletePost'])->name('post.delete');

// 報告！
Route::get('/report_post/{post}', [RegistrationController::class, 'showReportForm']);
Route::post('/submit_report/{post}', [RegistrationController::class, 'submitReport']);

// 新規エピソード投稿画面の名前
Route::get('/post_episode', [RegistrationController::class, 'showPostEpisodeForm']);
// いいね機能
Route::post('/like/{post}', [RegistrationController::class, 'likePost'])->name('like.store');
// コメント機能
Route::post('/comment/{post}', [RegistrationController::class, 'addComment'])->name('comment.store');

Route::get('/liked_posts', [RegistrationController::class, 'likedPosts'])->name('liked_posts');

// 検索
Route::get('/search', [RegistrationController::class, 'search'])->name('search');
// アカウント削除
Route::delete('/user/delete', [RegistrationController::class, 'destroy'])->name('user.delete');

Route::post('/register/confirm', [RegistrationController::class, 'showConfirmation'])->name('register.confirm');
Route::post('/register/store', [RegistrationController::class, 'store'])->name('register.store');
// 新規登録終わってログイン画面へ戻る
Route::get('/signup/complete', function () {
    return view('auth.signup_comp');  
})->name('signup.complete');

Route::get('/user_page/{id}', [RegistrationController::class, 'show'])->name('user.page');




