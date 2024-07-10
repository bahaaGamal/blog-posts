@extends('layout.app')

@section('title') show @endsection

    @section('content')
        <div class="card mt-4">
            <div class="card-header">
                Post Info
            </div>
            <div class="card-body">
                <div class="card-img text-center">
                    <img src="{{$post->image()}}" width="80%" height="350" alt="">
                </div>
                <h5 class="card-title">Title: {{$post['title']}}</h5>
                <p class="card-text">Description: {{$post['description']}}</p>
            </div> I
        </div>
        <div class="card mt-4">
            <div class="card-header">
                Post Creator Info
            </div>
            <div class="card-body">
                <h5 class="card-title"> Name: {{$post->user->name}}</h5>
                <p class="card-text">Email: {{$post->user->email}}</p>
                <p class="card-text">Created At: {{$post->user->created_at->format('y-m-d')}}</p>
            </div>
        </div>
    @endsection

