@extends('layout.app')

@section('title') Edit @endsection

@section('content')

<div class="col-12 text-center mb-4">
        <h1>Update Post</h1>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{route('posts.update',$post->id)}}"  enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input name="title" type="text" class="form-control" value="{{$post->title}}">
        </div>
        <div class="mb-3">
            <label  class="form-label">Description</label>
            <textarea name="description" class="form-control"  rows="3">{{$post->description}}</textarea>
        </div>

        <div class="mb-3">
            <label  class="form-label">Post Creator</label>
            <select name="post_creator" class="form-control">
                @foreach ($users as $user )
                    <option @selected($user->id == $post->user_id) value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label  class="form-label">Tags</label>
            <select name="tags[]" multiple class="form-control">
                @foreach ($tags as $tag )
                    <option @if ($post->tags->contains($tag)) selected @endif value="{{$tag->id}}">{{$tag->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Post Image</label>
            <input name="image" type="file" class="form-control">
        </div>
        <button class="btn btn-primary">Update</button>
    </form>


@endsection
