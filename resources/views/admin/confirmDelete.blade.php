@extends('admin.layouts.side')
@section('admin.content')

<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary rounded p-4">
        <h6 class="mb-4">Delete Account</h6>
        <p>Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.</p>
        <p>Are you sure?</p>
        <form method="post" action="{{ route('admin.profile.destroy') }}">
            @csrf
            <button id="delete" type="button" class="btn btn-primary">Sure</button>
            <a href="{{ route('admin.profile.edit') }}" class="btn btn-light m-2">back</a>
            @if(session()->has('error'))
                <span class="text-danger ms-3">{{ session('error') }}</span>
            @endif
            <div class="container" id="delForm">
                <input type="password" name="password" placeholder="Confirm your password" class="form-control my-3">
                <button id="delete" type="submin" class="btn btn-primary">Delete</button>
                <small>onse you click thare is no  going back.</small>
            </div>
        </form>
    </div>
</div>

<script>
    const del = document.getElementById('delete')
    const  delForm = document.getElementById('delForm')
    delForm.style.display = "none"
    del.addEventListener('click', ()=>{
        console.log(delForm)
        delForm.style.display = "block"
    })
</script>
@endsection
