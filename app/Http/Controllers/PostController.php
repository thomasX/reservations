<?php

namespace App\Http\Controllers;

use App\Models\Post;
use GuzzleHttp\Middleware;
use Illuminate\http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller implements HasMiddleware
{

    public static function middleware()
    {
        return [
            new Middleware('auth:Sanctum', except: ['index','show'])
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Post::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'title' => 'required|max:25',
            'body' => 'required'
        ]);

        $post = $request->user()->posts()->create($fields);
        return $post ;
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return $post ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        Gate::authorize('modify', $post);

        $fields = $request->validate([
            'title' => 'required|max:25',
            'body' => 'required'
        ]);

        $post->update($fields);
        return $post ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Gate::authorize('modify', $post);

        $post->delete();
        return [ 'message' => 'the post was deleted'];
    }
}
