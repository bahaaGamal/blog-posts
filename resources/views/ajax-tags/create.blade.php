@extends('layout.app')

@section('title') Create @endsection

@section('content')

    <div class="col-12 text-center mb-4">
        <h1>Create New Tag</h1>
    </div>

    <div class="alert alert-danger d-none" id="show-message"></div>
    <form method="POST" id="send-data" action="{{route('ajax-tags.store')}}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input name="name" type="text" class="form-control" value="{{old('name')}}">
        </div>
        <button class=" my-4 btn btn-success">Submit</button>
    </form>

@endsection

@section('script')

    <script>
        let formElemnt = document.getElementById('send-data');
        let messageElemnt = document.getElementById('show-message');

        formElemnt.addEventListener('submit',function(e){
            e.preventDefault();
            let input =document.querySelector("input[name='name']");
            let token =document.querySelector("input[name='_token']");
            fetch(formElemnt.action,{
                method: 'POST',
                headers:{
                    'X-CSRF-TOKEN': token.value,
                    'Accept':"application/json",
                    'Content-Type':"application/json",
                },
                body: JSON.stringify({name:input.value})
            }).then(data => {
               return data.json()
            }).then(data => {
                messageElemnt.classList.remove('d-none');
                if(data['status']){
                    messageElemnt.classList.remove('alert-danger');
                    messageElemnt.classList.add('alert-success');
                    input.value = '';
                }else{
                    messageElemnt.classList.remove('alert-success');
                    messageElemnt.classList.add('alert-danger');
                }
                messageElemnt.textContent = data.message;
            })
        })
    </script>

@endsection
