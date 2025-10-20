@extends('layouts.master')

@section('title', 'Index')

@section('content')
    <div class="content py-3 px-2 px-md-4" style="min-height: 100vh; overflow-y: auto;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <!-- Page Title -->
                    <div
                        class="page-title-box d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
                        <h4 class="page-title mb-2 mb-md-0">Submitted Applications</h4>
                    </div>

                    <!-- Card Container -->
                    <div class="card shadow-sm border-0 rounded-3">
                        <div class="card-body">

                            <!-- Success Message -->
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <!-- Responsive Table -->
                            <div class="table-responsive" style="max-height: 70vh; overflow-y: auto;">
                                <table class="table table-bordered align-middle mb-0">

                                    <thead class="bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100">
                                        <tr>
                                            <th scope="col" class="px-4 py-2">ID</th>
                                            <th scope="col" class="px-4 py-2">Full Name</th>
                                            <th scope="col" class="px-4 py-2">Email</th>
                                            <th scope="col" class="px-4 py-2">Phone</th>
                                            <th scope="col" class="px-4 py-2 text-center">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->full_name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->phone }}</td>
                                                <td class="text-center">
                                                    <div class="d-flex flex-wrap justify-content-center gap-1">
                                                        <a href="{{ route('form.view', $user->id) }}"
                                                            class="btn btn-info btn-sm">
                                                            View
                                                        </a>
                                                        <a href="{{ route('form.edit', $user->id) }}"
                                                            class="btn btn-warning btn-sm">
                                                            Edit
                                                        </a>
                                                        <form action="{{ route('form.delete', $user->id) }}" method="POST"
                                                            class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Delete this entry?')">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div
                                class="pt-3 d-flex flex-column flex-md-row justify-content-center justify-content-md-end align-items-center">
                                {{ $users->links('pagination::bootstrap-5') }}
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
