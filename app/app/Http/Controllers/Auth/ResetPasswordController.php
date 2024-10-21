<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;  // 追加
use Illuminate\Support\Facades\Hash;      // 追加
use Illuminate\Support\Str;               // 追加
use App\Providers\RouteServiceProvider;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * パスワードリセットフォームの表示
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    /**
     * パスワードを更新する処理
     */
    public function reset(Request $request)
    {
        // バリデーション
        // dd($request->all());
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
            'token' => 'required',
        ]);

        // パスワードリセット処理
        $status = Password::reset(
            $request->only('email', 'password', 'token'),
            function ($user, $password) {
                // 新しいパスワードをハッシュ化して保存
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();

                // リメンバートークンを更新
                $user->setRememberToken(Str::random(60));
                
            }
        );
        // dd($status);
        // リセットが成功したかどうかでリダイレクトを変更
        if ($status === Password::PASSWORD_RESET) {
            return view('auth.passwords.pwd_comp')->with('status', __('パスワードが正常にリセットされました'));
        } else {
            return back()->withErrors(['email' => [__('パスワードリセットに失敗しました。')]]);
        }
        
    }

    /**
     * パスワードリセット後のリダイレクト先
     */
    // protected function redirectTo()
    // {
    //     return '/password/reset/complete';
    // }
}
