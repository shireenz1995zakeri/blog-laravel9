<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index(){
        $users_count = User::count();
        $posts_count = Post::count();
        $comments_count =Comment::count();
        $categories_count =Category::count();

        if(auth()->user()->role === 'author'){
            $posts_count = Post::where('user_id', auth()->user()->id)->count();
            $comments_count =Comment::whereHas('post',function($query){
                    return $query->where('user_id',auth()->user()->id);
            })->count();
        }
        return view('panel.index',compact('users_count','posts_count','categories_count','comments_count'));
    }
}
