<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    //Read ==> Untuk tampilkan data yang ada di database
    //function index berfungsi untuk melihat keseluruhan data secara singkat
    public function index(){
        $posts = Post::latest()->paginate(3);
        $categories = Category::get();
        return view('post.index', compact('posts', 'categories'));
    }

    //function show menampilkan 1 data secara detail
    public function show(Post $post){
        return view('post.show', compact('post'));
    }

    //Create
    //create lebih ke tampilan
    public function create(){
        $categories = Category::get();
        $tags = Tag::get();
        return view('post.create', compact('categories', 'tags'));
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
        // image harus di upload sebagai image dengan file yang diterima itu png, jpg, jpeg, gif dengan maximum size 2mb
            'image' => 'image|mimes:png,jpg,jpeg,gif|max:2048',
            'desc'=>'required|min:5|max:500'
        ]);
        $attr = $request->all();
        $attr['slug'] = \Str::slug($request->title);
        $attr['category_id'] = $request->get('category_id');

        //user mengirimkan file masukkan ke folder storage di dalam folder images
        $attr['image'] = $request->file('image')->store("images/");
        //User bisa post setelah di login atau melakukan authentikasi
        //Post melakukan create data
        $post = auth()->user()->posts()->create($attr);
        $post->tags()->attach($request->get('tags'));
        return redirect('/post')->with('success', 'Post berhasil dimasukkan');
        // return dd($attr);
    }

    //edit
    //lebih ke tampilan post yang mau diupdate
    public function edit(Post $post){
        $categories = Category::get();
        $tags = Tag::get();
        return view('post.edit', compact('post', 'categories', 'tags'));
    }

    //update
    //mengirim data update pada post yang mau diupdate
    public function update(Request $request, Post $post){
        $request->validate([
            'title'=>'required|min:5|max:30',
            'image' => 'mimes:png,jpg,jpeg,gif|max:2048',
            'desc'=>'required|min:5|max:500'
        ]);
        $attr = $request->all();
        $attr['slug'] = \Str::slug($request->title);
        $attr['category_id'] = $request->get('category_id');
        //buang image lama ganti image baru
        if($request->file('image')){
            Storage::delete($post->image);
            $imageFile = $request->file('image')->store("images");
        }else{
            $imageFile = $post->image;
        }
        $attr['image'] = $imageFile;
        $user_id = auth()->user()->id;
        $attr['user_id'] = $user_id;
        $post->update($attr);
        // $post->tags()->detach($post->tags());
        $post->tags()->attach($request->get('tags'));
        return redirect('/post')->with('success', 'Post berhasil diedit');
    }

    //delete
    public function delete(Post $post){
        //buang image sekalian buang post
        Storage::delete($post->image);
        $post->delete();
        return redirect('/post')->with('success', 'Post berhasil didelete');
    }
}
