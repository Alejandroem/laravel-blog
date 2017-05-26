<?php

namespace App\Http\Controllers;

use App\Post;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    //

    public function index(){
        $posts = Post::latest()->get();
        return view('posts.index',compact('posts'));
    }

    public function show(Post $post){
        return view('posts.show',compact('post'));
    }
    public function create(){
        return view('posts.create');
    } 

    public function store(){
        /*Post::create([
           'title' => request('title'),
            'body' => request('body')
            
        ]);*/

        
        $this->validate(request(),[
           'title' => 'required|max:10',
            'body' => 'required'
        ]);
        Post::create(request(['title','body']));
        
        return redirect('/');
    }

   
}
