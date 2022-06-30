<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Get a post
     */
    public function index(Post $post)
    {
        return response()->json($post, 200);
    }

    /**
     * create post
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'site_id' => ['required', 'integer', 'exists:sites,id'],
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'validation error', 'error'=>$validator->errors()], 400);
        }

        try {
            $dir = 'public/photos/'; 
            $name = bin2hex(random_bytes(10)) .'.'. $request->image->getClientOriginalExtension();
            $request->image->storeAs($dir, $name);

            $validated = $validator->validated();
            $validated['image'] = $name;
            $post = Post::create($validated);

            return response()->json($post, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
