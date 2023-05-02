<?php

namespace App\Http\Controllers\Panel;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(isset($request->approved)){
            $comments = Comment::where('is_approved',!! $request->approved)->with(['user','post'])->withCount('replies')->paginate();

        }else{
            $comments = Comment::with(['user','post'])->withCount('replies')->paginate();

        }
        return view('panel.comments.index',compact('comments')); 
    }


    public function store(Request $request)
    {
        //
    }

    public function update(Request $request,Comment $comment)
    {
        $comment->update([
            'is_approved'=> ! $comment->is_approved
        ]
           
        );
        $request->session()->flash('status', ' نظر به درستی ویرایش شد');

        return back();
    }

    public function destroy(Request $request,Comment $comment)
    {
        $comment->delete();
        $request->session()->flash('status', ' نظر به درستی حذف شد');

        return back();
    }
}
