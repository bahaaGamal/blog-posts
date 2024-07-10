@extends('layout.app')

@section('title') index @endsection

    @section('content')

        <div class="text-center my-4">
            @can('create',\App\Models\Tag::class)
            <a href="{{route('ajax-tags.create')}}" class="btn btn-success">Add New Tag</a>
            @endcan
        </div>
        <div class="alert alert-danger d-none" id="show-message"></div>
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
                        <a href="{{route('ajax-tags.edit',$tag['id'])}}" class="btn btn-primary">Edit</a>
                        @endcan
                        <form style="display: inline;" class="delete-tag" method="POST" action="{{route('ajax-tags.destroy', $tag['id'])}}">
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

@section('script')
    <script>
        let item =document.querySelectorAll(".delete-tag");
        let messageElemnt = document.getElementById('show-message');

        item.forEach(element => {
            element.addEventListener('submit',function(e){
                e.preventDefault();

                let token =document.querySelector("input[name='_token']");

                fetch(element.action,{
                method: 'DELETE',
                headers:{
                    'X-CSRF-TOKEN': token.value,
                    'Accept':"application/json",
                    'Content-Type':"application/json",
                }}).then(data => {
               return data.json()
            }).then(data => {
                messageElemnt.classList.remove('d-none');
                if(data['status']){
                    messageElemnt.classList.remove('alert-danger');
                    messageElemnt.classList.add('alert-success');
                    element.closest('tr').remove();
                }else{
                    messageElemnt.classList.remove('alert-success');
                    messageElemnt.classList.add('alert-danger');
                }
                messageElemnt.textContent = data.message;
            })
        })
        });
    </script>

@endsection
