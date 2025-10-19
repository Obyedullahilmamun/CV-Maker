@extends('layouts.master')

@section('title', 'User Details')

@section('content')
    <div class="container mt-4">
        <h3>User Details</h3>
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Roles:</strong>
            @foreach ($user->roles as $role)
                <span class="badge bg-info">{{ $role->name }}</span>
            @endforeach
        </p>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
    </div>
@endsection
