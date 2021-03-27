<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category){
        $posts = $category->posts()->latest()->paginate(3);
        $categories = Category::get();
        return view('post.index', compact('posts', 'categories'));
    }
}
