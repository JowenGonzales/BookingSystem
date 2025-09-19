@extends('staff.staff_layout')
@section('page-title' , "Manage Users")
@section('page-breadcrumb')
    <li class="breadcrumb-item active">Users</li>
    <li class="breadcrumb-item active">Manage Users</li>
@endsection
@section('content')

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-users me-1"></i>
                Manage Users
            </div>

        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Registered At</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst($user->role) }}</td>
                        <td>
                            <x-status-badge :status="$user->status ?? 'active'" />
                        </td>
                        <td>{{ $user->created_at->format('M d, Y h:i A') }}</td>
                        <td>
                            <a href="" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i>
                            </a>


                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
