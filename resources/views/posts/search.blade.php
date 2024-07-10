@extends('layout.app')

@section('title') show @endsection

    @section('content')
        <h1 class="my-5 text-center">All Posts</h1>
        @foreach ($posts as $post )
        <div class="card mt-4">
            <div class="card-header">
            {{$post->user_id}} - {{$post->created_at->format('y-m-d')}}
            </div>
            <div class="card-body">
                <div class="card-img text-center">
                    <img src="{{$post->image()}}" width="80%" height="350" alt="">
                </div>
                <h5 class="card-title">Title: {{$post['title']}}</h5>
                <p class="card-text">Description: {{Str::limit($post['description'],50)}}</p>
            </div> I
        </div>
        @endforeach
    @endsection

