<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{
    public function index()
    {
        return view('adminpage'); // 管理者専用のビューを返す
    }

    // 報告件数の多いユーザーを取得するメソッド
    public function getReportedUsers()
    {
        // 各ユーザーごとに報告件数をカウントして、件数が多い順にソート
        $users = User::withCount('reports') // reportsテーブルとのリレーションを仮定
        ->where('role', '!=', 2)
                    ->orderBy('reports_count', 'desc')
                    ->get();

        return view('reported_users', ['users' => $users]);
    }
}



