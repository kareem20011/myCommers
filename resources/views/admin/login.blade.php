@extends('admin.layouts.auth')
@section('admin.auth')


<div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sign In Start -->
        <div class="container-fluid">
            <form action="{{ route('admin.login') }}" method="post" >
            @csrf
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="#" class="">
                                <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Admin</h3>
                            </a>
                            <h3>Sign In</h3>
                        </div>
                        @if(Session::has('error'))
                        <p class="text-danger text-center">{{ Session::get('error') }}</p>
                        @endif
                        <div class="form-floating mb-3">
                            <input value="{{ old('login') }}" name="login" type="text" class="form-control" id="floatingInput" placeholder="Email /  Username">
                            <label for="floatingInput">Email /  Username</label>
                            @error('login')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-floating mb-4">
                            <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword">Password</label>
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                            </div>
                            <a href="{{ route('forgot_password') }}">Forgot Password</a>
                        </div>
                        <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign In</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
        <!-- Sign In End -->
    </div>


@endsection
