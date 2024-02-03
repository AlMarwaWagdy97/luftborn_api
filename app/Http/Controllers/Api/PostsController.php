<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Traits\Api\ApiResponseTrait;
use App\Http\Requests\Api\PostRequest;

class PostsController extends Controller
{
    use ApiResponseTrait;
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(5);
        return $this->apiResponse(PostResource::collection($posts), null, 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $post = Post::create($request->validated());
        return $this->apiResponse(new PostResource($post), trans('The post has been added successfully'), 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);
        if (!$post) {
            return $this->apiResponse(null, trans('Post not found.'), 404);
        }
        return $this->apiResponse(new PostResource($post), null, 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, string $id)
    {
        $post = Post::find($id);
        if (!$post) {
            return $this->apiResponse(null, trans('Post not found.'), 404);
        }
        $post->update($request->validated());
        return $this->apiResponse(new PostResource($post), trans('The post has been updated successfully'), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);
        if (!$post) {
            return $this->apiResponse(null, trans('Post not found.'), 404);
        }
        $post->delete();
        return $this->apiResponse(null, trans('Post is deleted successfully'), 200);
    }
}
