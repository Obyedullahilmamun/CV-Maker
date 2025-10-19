@extends('layouts.master')

@section('title', 'Index')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                        <h4 class="page-title">Submitted Applications</h4>
                    </div>


                    <div class="card-container shadow p-4 rounded border">

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-bordered mt-3">

                                <thead class="table-header">
                                    <tr>
                                        <th>ID</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->full_name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>
                                                <a href="{{ route('form.view', $user->id) }}"
                                                    class="btn btn-info btn-sm mb-1">View</a>
                                                <a href="{{ route('form.edit', $user->id) }}"
                                                    class="btn btn-warning btn-sm mb-1">Edit</a>
                                                <form action="{{ route('form.delete', $user->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf @method('DELETE')
                                                    <button class="btn btn-danger btn-sm mb-1"
                                                        onclick="return confirm('Delete this entry?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Pagination under title (on small screens stacked, on large aligned right) -->
                    <div class="pt-2">
                        {{ $users->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
