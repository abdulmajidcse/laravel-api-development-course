<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * index
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest('id')->get();
        return response()->json([
            'success' => true,
            'message' => 'All posts',
            'data' => $posts,
        ]);
    }

    /**
     * store
     * 
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|integer',
            'title' => 'required|string|max:180|unique:posts',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'content' => 'required|string',
        ]);

        // return form validation error with json if error occured
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error occured',
                'errors' => $validator->getMessageBag(),
            ], 422);
        }

        $data = $validator->validated();

        // add post slug
        $data['slug'] = Str::slug($data['title']);

        // photo will upload if exist
        if (array_key_exists('photo', $data)) {
            $data['photo'] = Storage::putFile('', $data['photo']);
        }

        // store a new post
        Post::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Post created successfully!',
            'data' => [],
        ], 201);
    }

    /**
     * show
     *
     * @param  mixed Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return response()->json([
            'success' => true,
            'message' => 'Post details.',
            'data' => $post,
        ]);
    }

    /**
     * update
     *
     * @param  Illuminate\Http\Request $request
     * @param  mixed Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|integer',
            'title' => 'required|string|max:180|unique:posts,title,' . $post->id,
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'content' => 'required|string',
        ]);

        // return form validation error with json if error occured
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error occured',
                'errors' => $validator->getMessageBag(),
            ], 422);
        }

        $data = $validator->validated();

        // add post slug
        $data['slug'] = Str::slug($data['title']);

        // photo will upload if exist
        if (array_key_exists('photo', $data)) {
            Storage::delete($post->photo);
            $data['photo'] = Storage::putFile('', $data['photo']);
        }

        // store a new post
        $post->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Post updated successfully!',
            'data' => [],
        ]);
    }

    /**
     * destroy
     *
     * @param  mixed Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Storage::delete($post->photo);
        $post->delete();

        return response()->json([
            'success' => true,
            'message' => 'Post deleted successfully!',
            'data' => [],
        ]);
    }
}
