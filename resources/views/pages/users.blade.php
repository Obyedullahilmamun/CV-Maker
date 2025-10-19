@extends('layouts.master')

@section('title', 'Manage Users')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Manage Users</h4>
            <a href="#" class="btn btn-primary">+ Create User</a> {{-- You can link this later --}}
        </div>

        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-header">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Roles</th> {{-- Placeholder for future Spatie roles --}}
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>


                            <td>
                                @if ($user->roles->count())
                                    @foreach ($user->roles as $role)
                                        <span class="badge bg-info text-dark">{{ $role->name }}</span>
                                    @endforeach
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>


                            {{-- <td class="text-center">
                                <a href="#" class="btn btn-sm btn-success">Show</a>
                                <a href="#" class="btn btn-sm btn-warning">Edit</a>
                                <form action="#" method="POST" class="d-inline-block"
                                    onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                                </form>
                            </td> --}}

                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-sm">Show</a>
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                        style="display:inline-block;"
                                        onsubmit="return confirm('Are you sure you want to delete this user?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-3">
            {{ $users->links() }}
        </div>
    </div>
@endsection
