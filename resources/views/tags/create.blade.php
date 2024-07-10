@extends('layout.app')

@section('title') Create @endsection

@section('content')

    <div class="col-12 text-center mb-4">
        <h1>Create New Tag</h1>
    </div>

    @include('inc.message')

    <form method="POST" action="{{route('tags.store')}}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input name="name" type="text" class="form-control" value="{{old('name')}}">
        </div>
        <button class=" my-4 btn btn-success">Submit</button>
    </form>


@endsection
