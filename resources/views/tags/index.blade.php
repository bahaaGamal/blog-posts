@extends('layout.app')

@section('title') index @endsection

    @section('content')

        <div class="text-center my-4">
            @can('create',\App\Models\Tag::class)
            <a href="{{route('tags.create')}}" class="btn btn-success">Add New Tag</a>
            @endcan
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Posts</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($tags as $tag )
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$tag->name}}</td>
                    <td>
                        @foreach ($tag->posts as $post )
                            <span class="badge bg-success my-1">{{$post->title}}</span>
                            <br>
                        @endforeach
                    </td>
                    <td>
                        @can('view',$tag)
                        <a href="{{route('tags.edit',$tag['id'])}}" class="btn btn-primary">Edit</a>
                        @endcan
                        <form style="display: inline;" method="POST" action="{{route('tags.destroy', $tag['id'])}}">
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
            {{$tags->links()}}
        </div>
    @endsection


