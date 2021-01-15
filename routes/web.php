<?php

use App\Http\Controllers\PostController;
use App\Models\Post;
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
Route::view('/', 'welcome')->name('welcome');
Route::view('/asoidnasoidjsaoidjoi', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');

Route::prefix('/post')->group(function(){
    Route::get('', [PostController::class, 'index'])->name('post.index');
    Route::get('create', [PostController::class, 'create'])->name('post.create');
    Route::post('store', [PostController::class, 'store'])->name('post.store');
    Route::get('{post:slug}', [PostController::class, 'show'])->name('post.show');
    Route::get('edit/{post:slug}', [PostController::class, 'edit'])->name('post.edit');
    Route::patch('update/{post:slug}', [PostController::class, 'update'])->name('post.update');
    Route::delete('delete/{post:slug}', [PostController::class, 'delete'])->name('post.delete');
});
