<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AjaxTagController;

Route::get('/', function () {
    $posts = Post::all();
    return view('home', compact('posts'));
})->name('home');
Route::get('/posts/search',[PostController::class,"search"])->name('posts.search');

Route::middleware('auth')->group(function(){
    Route::get('/posts',[PostController::class,"index"])->name('posts.index');
    Route::get('/posts/create',[PostController::class,"create"])->name('posts.create');
    Route::post('/posts',[PostController::class,"store"])->name('posts.store');
    Route::get('/posts/{post}',[PostController::class,"show"])->name('posts.show');
    Route::get('/posts/{post}/edit',[PostController::class,"edit"])->name('posts.edit');
    Route::put('/posts/{post}',[PostController::class,"update"])->name('posts.update');
    Route::delete('/posts/{post}',[PostController::class,"destroy"])->name('posts.destroy');

    Route::resource('users',UserController::class)->middleware('can:admin-control');
    Route::get('user/{user}/posts',[UserController::class,"posts"])->name('user.posts');

    Route::resource('tags',TagController::class)->middleware('can:admin-control');
    Route::resource('ajax-tags',AjaxTagController::class)->middleware('can:admin-control');
});


Auth::routes();
