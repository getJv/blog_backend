<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function index()
    {

        return response(Post::all());
    }

    public function save(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:55',
            'content' => 'required|min:10'

        ]);

        try {

            $validatedData['author'] = 'jhonatan'; // \Auth::user()->email

            $post = Post::create($validatedData);

            return response(['post' => $post]);
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

    public function remove( $id)
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
