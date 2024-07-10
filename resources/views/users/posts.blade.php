@extends('layout.app')

@section('title') index @endsection

    @section('content')

        <div class="text-center my-4">
            <a href="{{route('posts.create')}}" class="btn btn-success">Create Post</a>
            <h1 class="'p-3 my-3 text-center">All User For {{$user->name}}</h1>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Posted By</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($user->posts as $post )
                <tr>
                    <td>{{$post->id}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->user->name}}</td>
                    <td>{{$post->created_at->format('y-m-d')}}</td>
                    <td>
                        <a href="{{route('posts.show',$post['id'])}}" class="btn btn-info">View</a>
                        <a href="{{route('posts.edit',$post['id'])}}" class="btn btn-primary">Edit</a>
                        <form style="display: inline;" method="POST" action="{{route('posts.destroy', $post['id'])}}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endsection


