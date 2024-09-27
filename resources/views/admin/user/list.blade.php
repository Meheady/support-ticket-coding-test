@extends('admin.layout')

@section('content')
    <div class="container">
        <h2>Admin Users</h2>

        <a href="{{ route('admin.create') }}" class="btn btn-info mb-3">Create New Admin</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($admins as $admin)
                <tr>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>
                        <a href="{{ route('admin.delete', $admin->id) }}" class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure delete this admin?');">Delete
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
