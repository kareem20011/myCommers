@extends('admin.layouts.side')
@section('admin.content')



<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary rounded p-4">
        <h6 class="mb-4">Edit User:</h6>
        <form method="post" action="{{ route('admin.user.update', $user->id) }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input name="name" type="text" class="form-control" id="name" aria-describedby="emailHelp" value="{{$user->name}}">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Username</label>
                <input name="username" type="text" class="form-control" id="username" aria-describedby="emailHelp" value="{{$user->username}}">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$user->email}}">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">address</label>
                <input name="address" type="text" class="form-control" id="address" aria-describedby="emailHelp" value="{{$user->address}}">
            </div>

             <!-- Role -->

            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0">Role</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="role" id="gridRadios1" value="user" {{$user->role === 'user' ? 'checked' : ''}}>
                        <label class="form-check-label" for="gridRadios1">
                            User
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="role" id="gridRadios2" value="dealer" {{$user->role === 'dealer' ? 'checked' : ''}}>
                        <label class="form-check-label" for="gridRadios2">
                            Dealer
                        </label>
                    </div>
                </div>
            </fieldset>










            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
