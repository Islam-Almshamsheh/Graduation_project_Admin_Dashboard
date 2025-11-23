<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth'); //home is public
    }

    public function index()
    {
        // $posts = Post::with('tags', 'user', 'category')->latest()->take(6)->get();
        // return view('pages.home', compact('posts'));
        return view('pages.home');
    }
    
    public function show(Post $post)
    {
      return view('pages.show',compact('post'));
    }
}
