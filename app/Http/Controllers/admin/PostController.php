<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use function Pest\Laravel\post;
use Illuminate\Support\Facades\Storage;
class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index',compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create',compact('categories'));
    }

    public function store()
    {
        request()->validate([
            'title' => 'required|string|min:3|max:255',
            'post' => 'required|string|min:15',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if(request()->hasFile('image')){
            $imagePath = request()->file('image')->store('posts', 'public');
        }
      //  dd(request()->all());
        $post = auth()->user()->posts()->create([
           'title' =>  request()->title,
           'post' => request()->post,
           'image' => $imagePath ?? null,
           // ??null as the imagePath variable may be undefined
           'category_id' => request()->category_id,
        ]);

        if(!empty(request()->tags))
        {
            $tags = explode(',',request()->tags);
            
            $tagIds = [];
            foreach($tags as $tagName)
            {
                $tagName = trim($tagName);
                if(!empty($tagName))
                {
                    $tag = Tag::firstOrCreate(['name'=> $tagName]);//in both ways if exists or not we will have a tag instance
                    $tagIds[]= $tag->id;
                }
            }
            $post->tags()->attach($tagIds);
        }

        return to_route('admin.posts.index')->with('success', 'post created successfully');
        // When a user uploads an image using a form:
        //    1. The image comes as a file in the request.
        //    2. Laravel provides built-in helpers to validate, store, and get the path to that image.
        //    3. You store that path in the database, not the actual image.
    }

    public function show(Post $post)
    {
        return view('admin.posts.show',compact('post'));
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return to_route('admin.posts.index')->with('success','post deleted successfully');
    }

    public function edit(Post $post)
    {

        $categories = Category::all();
        return view('admin.posts.edit',compact('post','categories'));
    }

    public function update(Post $post)
    {
        request()->validate([
            'title' => 'required|string|min:3|max:255',
            'post' => 'required|string|min:15',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'nullable|string',
        ]);
        if(request()->hasFile('image')){
            if($post->image) {
                Storage::disk('public')->delete($post->image);//delete image if exists
            }
            $imagePath = request()->file('image')->store('posts', 'public');
        }
        $post->update([
            'title' => request()->title,
            'post' => request()->post,
            'image' => $imagePath ?? $post->image,
            'category_id' => request()->category_id,
        ]);
        if(!empty(request()->tags))
        {
            $tags = explode(',',request()->tags);
            
            $tagIds = [];
            foreach($tags as $tagName)
            {
                $tagName = trim($tagName);
                if(!empty($tagName))
                {
                    $tag = Tag::firstOrCreate(['name'=> $tagName]);//in both ways if exists or not we will have a tag instance
                    $tagIds[]= $tag->id;
                }
            }
            $post->tags()->sync($tagIds);
        }
        return to_route('admin.posts.show',$post->id)->with('success','post updated successfully');
    }
}
