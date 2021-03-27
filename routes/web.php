<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::get() ==> view data
//Route::post() ==> kirim data
//Route::patch() / Route::put() ==> update
//Route::delete() ==> delete data
Route::get('/', function(){
    return view('layouts.app');
});
Route::view('/asoidnasoidjsaoidjoi', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');

Auth::routes();
Route::middleware('auth')->group(function(){
    Route::prefix('/post')->group(function(){
        Route::get('', [PostController::class, 'index'])->name('post.index')->withoutMiddleware('auth');
        Route::get('create', [PostController::class, 'create'])->name('post.create');
        Route::post('store', [PostController::class, 'store'])->name('post.store');
        Route::get('{post:slug}', [PostController::class, 'show'])->name('post.show')->withoutMiddleware('auth');
        Route::get('edit/{post:slug}', [PostController::class, 'edit'])->name('post.edit');
        Route::patch('update/{post:slug}', [PostController::class, 'update'])->name('post.update');
        Route::delete('delete/{post:slug}', [PostController::class, 'delete'])->name('post.delete');
    });
});
Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('category');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
