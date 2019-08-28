<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = DB::connection('mongodb')->table('posts')
                ->orderBy('created_at', 'desc')
                ->get();

        return response($posts);
    }

    public function save(Request $request)
    {

        

        $validatedData = $request->validate([
            'title' => 'required|max:55',
            'content' => 'required|min:10',
            'image' => 'required|url'

        ]);

        

        try {
            
            $validatedData['author'] = \Auth::user()->email;

            $post = Post::create($validatedData);

            

            return response($post);
        } catch (\Exception $e) {
            return response(['error' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:55',
            'content' => 'required|min:10'

        ]);

        try {

            $post = Post::find($id);
            $post->title    = $validatedData['title'];
            $post->content  = $validatedData['content'];
            $post->save();

            return response(['post' => $post]);
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
