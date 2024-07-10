<?php

namespace App\Http\Controllers;

use File;
use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function index()
    {
        $postsFromDB = Post::orderBy('id','DESC')->paginate(10);

        return View("posts.index",['posts' => $postsFromDB]);
    }

    public function show(Post $post){
        // $singlePostFromDB = Post::findOrFail($postId);
        // $singlePost = ['id' => 1, 'title' => 'PHP','description'=> 'PHP is cool language', 'posted_by' => 'Ahmed', 'created_at' => '2022-10-10 09:00:00'];
        return View("posts.show", ['post'=> $post]);
    }

    public function search(){
        $q = request()->q;

        $posts =Post::where("title","LIKE","%".$q."%")->get();
        return View("posts.search",['posts' => $posts]);

    }

    public function create(){
        Gate::authorize('create-post');

        $users = User::select('id','name')->get();
        $tags = Tag::select('id','name')->get();
        return View("posts.create", compact('users','tags'));
    }

    public function store(){
        Gate::authorize('create-post');

        request()->validate([
            'title' => ['required','min:6'],
            'description' => ['required'],
            'post_creator' => ['required','exists:users,id'],
            'image' => ['required','image','mimes:png,jpg,jpeg,gif']
        ]);

        $image = request()->file('image')->store('public');

        $title = request()->title;
        $description = request()->description;
        $postCreator = request()->post_creator;

        $post = new Post;

        $post->title = $title;
        $post->description = $description;
        $post->user_id = $postCreator;
        $post->image = $image;

        $post->save();

        $post->tags()->sync(request()->tags);

        return to_route('posts.index');
    }

    public function edit(Post $post){
        $users = User::all();
        $tags = Tag::select('id','name')->get();
        return View("posts.edit", compact('users','tags','post'));
    }

    public function update($id){
        $post = Post::findOrFail($id);

        request()->validate([
            'title' => ['required','min:6'],
            'description' => ['required'],
            'post_creator' => ['required','exists:users,id']
        ]);

        $title = request()->title;
        $description = request()->description;
        $postCreator = request()->post_creator;
        $old_image = $post->image;


        if(request()->hasFile('image')){
            $new_image = request()->file('image')->store('public');
            File::delete($old_image);
            $post->image = $new_image;
        }

        $post->title = $title;
        $post->description = $description;
        $post->user_id = $postCreator;

        $post->save();

        $post->tags()->detach();
        $post->tags()->sync(request()->tags);

        return to_route('posts.show', $id);
    }

    public function destroy($id){
        $post = Post::findOrFail($id);

        $post->delete();

        return to_route('posts.index');
    }
}
