@extends('layout.app')

@section('title') Create @endsection

@section('content')

    <div class="col-12 text-center mb-4">
        <h1>Create New User</h1>
    </div>

    @include('inc.message')

    <form method="POST" action="{{route('users.store')}}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input name="name" type="text" class="form-control" value="{{old('name')}}">
        </div>
        <div class="mb-3">
            <label class="form-label">Eamail</label>
            <input name="email" type="email" class="form-control" value="{{old('email')}}">
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input name="password" type="password" class="form-control" value="{{old('password')}}">
        </div>
        <div class="mb-3">
            <label class="form-label">Comfirm Password</label>
            <input name="comfirm_password" type="comfirm_password" class="form-control" value="{{old('comfirm_password')}}">
        </div>
        <div class="mb-3">
            <label  class="form-label">Type</label>
            <select name="type" class="form-control">
                <option value="admin">Admin</option>
                <option value="writer">Writer</option>
            </select>
        </div>
        <button class=" my-4 btn btn-success">Submit</button>
    </form>


@endsection
