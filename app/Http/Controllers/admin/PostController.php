<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// remove them to use firestore instead of MySQL
// use App\Models\Post;
// use App\Models\Category;
// use function Pest\Laravel\post;
use App\Services\FirebaseService;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    protected $firebase;

    public function __construct(FirebaseService $firebase)
    {
        $this->firebase = $firebase;
    }

    // List all events
    public function index()
    {
        $events = $this->firebase->getCollection('events'); // Using Firebase 'events' collection
        return view('admin.posts.index', compact('events'));
    }

    // Show create form
    public function create()
    {
        return view('admin.posts.create');
    }

    // Store new event
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:15',
            'date' => 'required|date',
            'category' => 'required|string|in:inline,online',
            'tags' => 'nullable|string', // comma-separated
            'location' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle image
        $imageUrl = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('events', 'public'); 
            $imageUrl = asset('storage/' . $imagePath);
        }

        // Tags array
        $tagsArray = [];
        if (!empty($request->tags)) {
            $tagsArray = array_map('trim', explode(',', $request->tags));
        }

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'category' => $request->category,
            'tags' => $tagsArray,
            'location' => $request->location,
            'image_url' => $imageUrl,
        ];

        $this->firebase->createDocument('events', $data);

        return redirect()->route('admin.posts.index')->with('success', 'Event created successfully in Firebase!');
    }

    // Show event details
    public function show($documentId)
    {
        $events = $this->firebase->getCollection('events');
        $event = collect($events['documents'] ?? [])->first(function($doc) use($documentId){
            return last(explode('/', $doc['name'])) === $documentId;
        });

        return view('admin.posts.show', compact('event'));
    }

    // Delete event
    public function destroy($documentId)
    {
        $this->firebase->deleteDocument('events', $documentId);
        return redirect()->route('admin.posts.index')->with('success', 'Event deleted successfully from Firebase!');
    }
}


// class PostController extends Controller
// {
//     public function index()
//     {
//         $posts = Post::all();
//         return view('admin.posts.index',compact('posts'));
//     }

//     public function create()
//     {
//         $categories = Category::all();
//         return view('admin.posts.create',compact('categories'));
//     }

//     public function store()
//     {
//         request()->validate([
//             'title' => 'required|string|min:3|max:255',
//             'post' => 'required|string|min:15',
//             'category_id' => 'required|exists:categories,id',
//             'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
//         ]);

//         if(request()->hasFile('image')){
//             $imagePath = request()->file('image')->store('posts', 'public');
//         }
//       //  dd(request()->all());
//         $post = auth()->user()->posts()->create([
//            'title' =>  request()->title,
//            'post' => request()->post,
//            'image' => $imagePath ?? null,
//            // ??null as the imagePath variable may be undefined
//            'category_id' => request()->category_id,
//         ]);

//         if(!empty(request()->tags))
//         {
//             $tags = explode(',',request()->tags);
            
//             $tagIds = [];
//             foreach($tags as $tagName)
//             {
//                 $tagName = trim($tagName);
//                 if(!empty($tagName))
//                 {
//                     $tag = Tag::firstOrCreate(['name'=> $tagName]);//in both ways if exists or not we will have a tag instance
//                     $tagIds[]= $tag->id;
//                 }
//             }
//             $post->tags()->attach($tagIds);
//         }

//         return to_route('admin.posts.index')->with('success', 'post created successfully');
//         // When a user uploads an image using a form:
//         //    1. The image comes as a file in the request.
//         //    2. Laravel provides built-in helpers to validate, store, and get the path to that image.
//         //    3. You store that path in the database, not the actual image.
//     }

//     public function show(Post $post)
//     {
//         return view('admin.posts.show',compact('post'));
//     }

//     public function destroy(Post $post)
//     {
//         $post->delete();
//         return to_route('admin.posts.index')->with('success','post deleted successfully');
//     }

//     public function edit(Post $post)
//     {

//         $categories = Category::all();
//         return view('admin.posts.edit',compact('post','categories'));
//     }

//     public function update(Post $post)
//     {
//         request()->validate([
//             'title' => 'required|string|min:3|max:255',
//             'post' => 'required|string|min:15',
//             'category_id' => 'required|exists:categories,id',
//             'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
//             'tags' => 'nullable|string',
//         ]);
//         if(request()->hasFile('image')){
//             if($post->image) {
//                 Storage::disk('public')->delete($post->image);//delete image if exists
//             }
//             $imagePath = request()->file('image')->store('posts', 'public');
//         }
//         $post->update([
//             'title' => request()->title,
//             'post' => request()->post,
//             'image' => $imagePath ?? $post->image,
//             'category_id' => request()->category_id,
//         ]);
//         if(!empty(request()->tags))
//         {
//             $tags = explode(',',request()->tags);
            
//             $tagIds = [];
//             foreach($tags as $tagName)
//             {
//                 $tagName = trim($tagName);
//                 if(!empty($tagName))
//                 {
//                     $tag = Tag::firstOrCreate(['name'=> $tagName]);//in both ways if exists or not we will have a tag instance
//                     $tagIds[]= $tag->id;
//                 }
//             }
//             $post->tags()->sync($tagIds);
//         }
//         return to_route('admin.posts.show',$post->id)->with('success','post updated successfully');
//     }
// }
