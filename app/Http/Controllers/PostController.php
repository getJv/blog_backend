<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\Http\Requests\PostsValidations;

class PostController extends Controller
{
    public function index()
    {
        $posts = DB::connection('mongodb')->table('posts')
            ->orderBy('created_at', 'desc')
            ->get();

        return response($posts);
    }

    public function save(PostsValidations $request)
    {

        try {
            $validatedData = $request->validated();
            $validatedData['author'] = \Auth::user()->email;

            $post = Post::create($validatedData);



            return response($post);
        } catch (\Exception $e) {
            return response(['error' => $e->getMessage()]);
        }
    }

    public function update(PostsValidations $request, $id)
    {
       
        try {
            $validatedData = $request->validated();

            $post = Post::find($id);
            $post->update($validatedData);

            return response($post);
        } catch (\Exception $e) {
            return response(['error' => $e->getMessage()]);
        }
    }

    public function find($id)
    {

        try {

            $post = Post::find($id);

            return response($post);
        } catch (\Exception $e) {
            return response(['error' => $e->getMessage()]);
        }
    }

    public function remove($id)
    {


        try {

            $post = Post::find($id);
            $post->delete();
            return response(['post' => $post]);
        } catch (\Exception $e) {
            return response(['error' => $e->getMessage()]);
        }
    }
}
