<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Post; 
use Illuminate\Http\Request;

class DisplayController extends Controller
{
    public function index()
    {
        $user_role = Auth::user()->role;
        // dd($user_role);
        if($user_role == 2){
            return redirect('/ownerpage');
            
        }
       
        // del_flagがfalseの投稿を取得し、作成日時の降順でソート
            $posts = Post::where('del_flag', false)
                        ->orderBy('created_at', 'DESC') // 作成日時の降順でソート
                        ->get();
            
            // 投稿データをビューに渡す
            return view('main', ['posts' => $posts]);

        
    }
    
    
}



