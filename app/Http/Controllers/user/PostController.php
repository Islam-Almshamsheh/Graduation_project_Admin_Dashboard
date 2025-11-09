<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
class PostController extends Controller
{
    public function index()
    {
        $userPosts = Post::where('user_id',auth()->id())->get();
        return view ('user.posts.index',compact('userPosts'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('user.posts.create',compact('categories','tags'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:3|max:255',
            'post' => 'required|string|min:15',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
        
        if(request()->hasFile('image')){
            $imagePath = request()->file('image')->store('posts', 'public');
        }
        $post = auth()->user()->posts()->Create([
            'title' =>  request()->title,
            'post' => request()->post,
            'image' => $imagePath ?? null,
            'category_id' => request()->category_id,
            // 'user_id' =>auth()->id(),handled automatically by auth()->user()->posts()->Create
         ]);
         
         if (!empty(request()->tags)) {
            $tagIds = request()->tags; // this is already an array of tag IDs
            $post->tags()->attach($tagIds);
        }

        return to_route('user.posts.index')->with('success', 'post created successfully');
    }

    public function show(Post $post)
    {
        if($post->user_id !== auth()->id()){
            abort(403);
        }
        return view('user.posts.show',compact('post'));
    }

    public function edit(Post $post)
    {
        if($post->user_id !== auth()->id()){
            abort(403);
        }
        $categories = Category::all();
        $tags = Tag::all();
        return view('user.posts.edit',compact('post','categories','tags'));
    }
    public function update(Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            abort(403);
        }
        request()->validate([
            'title' => 'required|string|min:3|max:255',
            'post' => 'required|string|min:15',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);
        if(request()->hasFile('image')){
            if($post->image) {
                Storage::delete($post->image);//delete image if exists
            }
            $imagePath = request()->file('image')->store('posts', 'public');
        }
        $post->update([
            'title' => request()->title,
            'post' => request()->post,
            'image' => $imagePath ?? $post->image,
            'category_id' => request()->category_id,
        ]);
        $post->tags()->sync(request()->input('tags', []));
        return to_route('user.posts.show',$post->id)->with('success','post updated successfully');
    }

    public function destroy(Post $post)
    {
        if($post->user_id !== auth()->id()){
            abort(403);
        }
        Storage::disk('public')->delete($post->image);
        return to_route('user.posts.index')->with('success','post deleted successfully');
    }
}
