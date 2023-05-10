<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

    // public function __construct(protected Post $post)
    // {
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct()
    public function index()
    {
        $posts = Post::latest()->with('tags')->get();

        return view('post.index',['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create-post');
        $tags = Tag::latest()->get();
        return view('post.create',compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        
        // $validated = $request->validated();
  
        try {
            DB::transaction(function () use ($request) {
    
                $post = Post::create([
                    'user_id' => auth()->id(),
                    'title' => $request['title'],
                    'description' => $request['description'],
                    'is_published' => isset($request['is_published']),
                ]);
    
                $post->tags()->sync($request['tags']);
    
            });
    
            return redirect()->route('post.index');
    
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $tags = join(', ',$post->tags->pluck('name')->toArray());

        return view('post.show', compact('post','tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $tags = Tag::latest()->get();
        $post_tags =$post->tags->pluck('id')->toArray();
        return view('post.edit', compact('post','tags','post_tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        // $validated = $request->validated();
        $this->authorize('update-post', $post);
        
        try {
            DB::transaction(function () use ($request, $post) {
    
                $post->update([
                    'user_id' => auth()->id(),
                    'title' => $request['title'],
                    'description' => $request['description'],
                    'is_published' => isset($request['is_published']),
                ]);
    
                $post->tags()->sync($request['tags']);
    
            });
    
            return redirect()->route('post.show', $post->id);
    
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
        
       
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('post.index');
    }
}
