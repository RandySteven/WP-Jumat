<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //Read ==> Untuk tampilkan data yang ada di database
    //function index berfungsi untuk melihat keseluruhan data secara singkat
    public function index(){
        $posts = Post::latest()->paginate(3);
        return view('post.index', compact('posts'));
    }

    //function show menampilkan 1 data secara detail
    public function show(Post $post){
        return view('post.show', compact('post'));
    }

    //Create
    //create lebih ke tampilan
    public function create(){
        return view('post.create');
    }

    //function store kirimin data
    public function store(Request $request){
        // Post::create([
        //     'title'=>$request->title,
        //     'desc'=>$request->desc,
        //     'slug'=>\Str::slug($request->title)
        // ]);
        $request->validate([
            'title'=>'required|min:5|max:30',
            'desc'=>'required|min:5|max:500'
        ]);
        $attr = $request->all();
        $attr['slug'] = \Str::slug($request->title);
        Post::create($attr);
        return redirect('/post')->with('success', 'Post berhasil dimasukkan');
    }

    //edit
    //lebih ke tampilan post yang mau diupdate
    public function edit(Post $post){
        return view('post.edit', compact('post'));
    }

    //update
    //mengirim data update pada post yang mau diupdate
    public function update(Request $request, Post $post){
        $request->validate([
            'title'=>'required|min:5|max:30',
            'desc'=>'required|min:5|max:500'
        ]);
        $post->update([
            'title'=>$request->title,
            'desc'=>$request->desc,
            'slug'=>\Str::slug($request->title)
        ]);
        return redirect('/post')->with('success', 'Post berhasil diedit');
    }

    //delete
    public function delete(Post $post){
        $post->delete();
        return redirect('/post')->with('success', 'Post berhasil didelete');
    }
}
