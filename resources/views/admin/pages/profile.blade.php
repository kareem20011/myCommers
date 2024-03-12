@extends('admin.layouts.side')
@section('admin.content')

@if(Session::has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fa fa-exclamation-circle me-2"></i>{{Session::get('success')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif


<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary rounded p-4">
        <h6 class="mb-4">Profile information</h6>
        <form method="post" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
            @csrf
            <!--Avatar-->
            <div>
                <div class="d-flex justify-content-center mb-4">
                    @if(count(auth('admin')->user()->getMedia('images')) > 0)
                    <img id="avatar" src="{{ auth('admin')->user()->getFirstMedia('images')->getUrl() }}"
                    class="rounded-circle" style="width: 200px; height: 200px; object-fit: cover;" alt="example placeholder" />
                    @else
                    <img class="rounded-circle" style="width: 200px; height: 200px; object-fit: cover;" src="{{ asset('media/temp.jpeg') }}" alt="" style="width: 40px; height: 40px;">
                    @endif
                </div>
                <div class="d-flex justify-content-center">
                    <div class="btn btn-primary btn-rounded">
                        <label class="form-label text-white m-1" for="customFile2">Choose file</label>
                        <input type="file" class="form-control d-none" id="customFile2" onchange="handleUserInfo(this, 'image')" />
                    </div>
                </div>
                <small id="fileName" class="text-center d-block m-1 text-success"></small>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input name="name" type="text" class="form-control" id="name" aria-describedby="emailHelp" value="{{auth('admin')->user()->name}}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input onchange="handleUserInfo(this, 'username')" type="text" class="form-control" id="username" aria-describedby="emailHelp" value="{{auth('admin')->user()->username}}">
                @error('username')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input onchange="handleUserInfo(this, 'email')" type="email" class="form-control" id="email" aria-describedby="emailHelp" value="{{auth('admin')->user()->email}}">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>

<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary rounded p-4">
        <h6 class="mb-4">Update Password</h6>
        <form method="post" action="{{ route('admin.profile.changePassword') }}">
            @csrf
            <div class="mb-3">
                <label for="currentPassword" class="form-label">Current Password</label>
                <input name="currentPassword" type="password" class="form-control" id="currentPassword" aria-describedby="emailHelp">
                @if(Session::has('worngPassword'))
                <p class="text-danger">{{Session::get('worngPassword')}}</p>
                @endif
                @error('currentPassword')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">New Password</label>
                <input name="password" type="password" class="form-control" id="username" aria-describedby="emailHelp">
                @if(Session::has('confirmError'))
                <p class="text-danger">{{Session::get('confirmError')}}</p>
                @endif
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm Password</label>
                <input name="confirmPassword" type="password" class="form-control" id="confirmPassword">
                @error('confirmPassword')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Change Passowrd</button>
        </form>
    </div>
</div>

<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary rounded p-4">
        <h6 class="mb-4">Delete Account</h6>
        <p>Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.</p>
        <a class="btn btn-primary" href="{{ route('admin.profile.confirmDelete') }}">Delete</a>
    </div>
</div>


<script>

    function handleUserInfo(e, value) {
        e.setAttribute('name', value)
        if (value === 'image') {
            document.getElementById('fileName').innerText = e.value
        }
    }



</script>
@endsection
