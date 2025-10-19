@extends('layouts.master')

@section('title', 'Show Role')

@section('content')
    <div class="container">
        <h2>Role: {{ $role->name }}</h2>

        <h4>Permissions:</h4>
        <ul>
            {{-- @foreach ($permissions as $permission) --}}
            @foreach ($role->permissions as $permission)
                <li>{{ $permission->name }}</li>
            @endforeach
        </ul>

        <a href="{{ route('roles.index') }}" class="btn btn-secondary mt-3">Back</a>
    </div>
@endsection
