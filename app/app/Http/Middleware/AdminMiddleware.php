<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        // dd('AdminMiddleware is working!');

        // ログインしているか確認
        if (Auth::check()) {
            // ユーザーが管理者（role == 2）であるか確認
            if (Auth::user()->role == 2) {
                return $next($request);  // 管理者なら次のリクエストを処理
            }
        }

        // 管理者でない場合はメインページにリダイレクト
        return redirect('/main');
    }
}
