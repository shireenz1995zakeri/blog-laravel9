<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\Panel\Post\CreatePostRequest;
use App\Http\Requests\Panel\Post\UpdatePostRequest;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PostController extends Controller
{
   
    public function index(Request $request)
    {
        if(auth()->user()->role === 'author'){
            $postsQuery=Post::where('user_id',auth()->user()->id)->with('user');
            
            if($request->search){
                $postsQuery->where('title','LIKE',"%{$request->search}%");

            }
            $posts=$postsQuery->paginate();
        }else{
            $postsQuery=Post::with('user');

            if($request->search){
                $postsQuery->where('title','LIKE',"%{$request->search}%");

            }
            $posts=$postsQuery->paginate();

        }
        return view('panel.posts.index',compact('posts'));
    }

 
    public function create()
    {
        return view('panel.posts.create');

    }


    public function store(CreatePostRequest $request)
    {
  
      $categoryIds =  Category::whereIn('name',$request->categories)->get()->pluck('id')->toArray();
     if(count($categoryIds)<1){
        throw ValidationException::withMessages([
            'categories'=>['دسته بندی یافت نشد.']
        ]);
     }

      $file = $request->file('banner');
      
      $file_name = $file->getClientOriginalName();
      
      $file->storeAs('images/banners', $file_name , 'public_files');
      $data=$request->validated();
      $data['banner'] = $file_name;
      $data['user_id']=auth()->user()->id;
      $post=Post::create(
        $data
      );
      $post->categories()->sync($categoryIds);
      session()->flash('status','مقاله درستی ایجاد شد');
      return redirect()->route('posts.index');

    }

   
    public function show(Post $post)
    {
        //
    }

  
    public function edit(Post $post)
    {
         return view('panel.posts.edit',compact('post'));
    }


    public function update(UpdatePostRequest $request, Post $post)
    {
        $categoryIds =  Category::whereIn('name',$request->categories)->get()->pluck('id')->toArray();
        if(count($categoryIds)<1){
           throw ValidationException::withMessages([
               'categories'=>['دسته بندی یافت نشد.']
           ]);
        }
        $data=$request->validated();
        

        if($request->hasFile('banner')){
            $file = $request->file('banner');
         
            $file_name = $file->getClientOriginalName();
            
            $file->storeAs('images/banners', $file_name , 'public_files');
            $data['banner'] = $file_name;
        }
       
        
         $post->update(
           $data
         );
         $post->categories()->sync($categoryIds);
         session()->flash('status','مقاله درستی ویرایش شد');
         return redirect()->route('posts.index');
    }


    public function destroy(Post $post)
    {
        $this->authorize('delete',$post);
        $post->delete();
        session()->flash('status', 'مقاله مورد نظر حذف شد');

        return back();
    }
}
