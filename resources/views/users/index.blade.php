@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h4 style="float: left;">ADD USER</h4>
                        <a href="#" style="float: right;" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addUser"><i class="fa fa-plus"></i> Add New Users</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-left">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $key => $user)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>@if($user->is_admin == 1)Admin @else Cashier @endif</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editUser{{ $user->id }}"><i class="fa fa-edit"></i>Edit</a>
                                            <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteUser{{ $user->id }}"><i class="fa fa-trash"></i>Del</a>
                                        </div>
                                    </td>
                                </tr>
                                {{-- Modal of Edit User Detail --}}
                                <div class="modal right fade" id="editUser{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Edit User</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                {{ $user->id }}
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('users.update', $user->id) }}" method="POST">
                                                    @csrf
                                                    @method('put')
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Name</label>
                                                        <input type="text" class="form-control" value="{{ $user->name }}" id="name" name="name" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input type="email" class="form-control" value="{{ $user->email }}" id="email" name="email" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="role" class="form-label">Role</label>
                                                        <select class="form-control" id="role" name="role">
                                                            <option value="1" @if($user->is_admin == 1) selected @endif>Admin</option>
                                                            <option value="2" @if($user->is_admin == 2) selected @endif>Cashier</option>
                                                        </select>
                                                    </div>
                                                    <button type="submit" class="btn btn-warning">Update</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Delete Section --}}
                                <div class="modal right fade" id="deleteUser{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Delete User</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                {{ $user->id }}
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <p>Are you sure you want to delete {{ $user->name }}?</p>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h4>SEARCH USER</h4>
                    </div>
                    <div class="card-body">
                        <!-- Search form can be added here -->
                        <input type="text" class="form-control" placeholder="Search...">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal for Adding New User --}}
<div class="modal right fade" id="addUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addUserLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserLabel">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-control" id="role" name="role">
                            <option value="1">Admin</option>
                            <option value="2">Cashier</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Add User</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .modal.right .modal-dialog {
        top: 0;
        right: 0;
        margin-right: 5vh;
    }
    .modal.fade:not(.in).right.modal-dialog {
        -webkit-transform: translate3d(25%, 0, 0);
        transform: translate3d(25%, 0, 0);
    }
</style>
