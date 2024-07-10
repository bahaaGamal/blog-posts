@extends('layout.app')

@section('title') index @endsection

    @section('content')
        <div>
            @can('create-post')
            <a href="{{route('posts.create')}}" class="btn btn-success">Create Post</a>
            @endcan
            <h1 class=" text-center border p-3 m-3">All Posts</h1>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Posted By</th>
                    <th scope="col">Tags</th>
                    <th scope="col">Image</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($posts as $post )
                <tr>
                    <td>{{$post->id}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->user->name}}</td>
                    <td>
                        @foreach ($post->tags as $tag )
                            <span class="badge bg-warning my-1">{{$tag->name}}</span>
                            <br>
                        @endforeach
                    </td>
                    <td><img src="{{asset($post->image())}}" height="75" width="75" alt=""></td>
                    <td>{{$post->created_at->format('y-m-d')}}</td>
                    <td>
                        <a href="{{route('posts.show',$post['id'])}}" class="btn btn-info">View</a>
                        @can('update-user',$post)
                        <a href="{{route('posts.edit',$post['id'])}}" class="btn btn-primary">Edit</a>
                        @endcan
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
        <div>
            {{$posts->links()}}
        </div>
    @endsection


