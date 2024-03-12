@extends('admin.layouts.side')
@section('admin.content')


<div class="col-12 container pt-5">
    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Users Data</h6>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Address</th>
                        <th scope="col">Role</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach( $users as $user )
                    <tr>
                        <th scope="row">{{$count ++}}</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->username}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->address}}</td>
                        <td>{{$user->role}}</td>

                        <td>
                            <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-outline-info m-2"><i class="fas fa-edit"></i></a>
                            <a href="{{ route('admin.user.destroy', $user->id) }}" class="btn btn-outline-danger m-2"><i class="fas fa-user-times"></i></a>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection
