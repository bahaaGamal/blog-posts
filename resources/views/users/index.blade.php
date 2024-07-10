@extends('layout.app')

@section('title') index @endsection

    @section('content')

        <div class="text-center my-4">
            <a href="{{route('users.create')}}" class="btn btn-success">Add New User</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Posts</th>
                    <th scope="col">Type</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($users as $user )
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        <a href="{{route('user.posts',$user['id'])}}" class="btn btn-primary">Show</a>
                    </td>
                    <td>{!!$user->type()!!}</td>
                    <td>
                        <a href="{{route('users.edit',$user['id'])}}" class="btn btn-primary">Edit</a>
                        <form style="display: inline;" method="POST" action="{{route('users.destroy', $user['id'])}}">
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
            {{$users->links()}}
        </div>
    @endsection


