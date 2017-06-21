<?php

namespace App\Http\Controllers;

use App\Post;
use App\Repositories\Posts;
use Illuminate\Http\Request;

use Carbon\Carbon;

class PostsController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth')->except(['index','show']);
    }

    //dependency inyecton over posts repositorie
    public function index(Posts $posts){
        //dd($posts);
        $posts = $posts->all();
            /*$posts = Post::latest()
            ->filter(request(['month','year']))//Acá podemos mandar a llamar un queryScope, que significa un query dentro dle modelo enviandole parametros
            ->get();*/


            //        $posts = Post::latest();
            //        
            //        // esto se mueve a scope filter de post.php
            //        if($month = request('month')){
            //            $posts->whereMonth('created_at', Carbon::parse($month)->month);
            //        }
            //        
            //        if($year = request('year')){
            //            $posts->whereYear('created_at', $year);
            //        }
            //        
            //        $posts = $posts->get();


            //        $archives = Post::selectRaw('year(created_at) year,monthname(created_at) month,count(*) published')
            //            ->groupBy('year','month')
            //            ->orderByRaw('min(created_at)')
            //            ->get()
            //            ->toArray();



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


        //        Post::create(request(['title','body','']));
        /*    Post::create([
            'title' => request('title'),
            'body' => request('body'),
            'user_id' => auth()->id()
        ]);*/

        //otro metodo para guardar

        auth()->user()->publish(new Post(request(['title','body'])));//le envia una instancia de post

        return redirect('/');
    }
        public function test(Request $request){

            if (!$request->has('trial_end')) { //this is what you have wrong
                $request->merge(array('trial_end' => 'test'));
            }
            return $request->get('trial_end');
        }

}
