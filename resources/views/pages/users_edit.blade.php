@extends('layouts.master')

@section('title', 'Edit User Roles')

@section('content')
    <div class="container mt-4">
        <h2>Edit Roles for {{ $user->name }}</h2>

        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="roles" class="form-label">Assign Roles</label>
                <select name="roles[]" id="roles" class="form-select" multiple>
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}" {{ in_array($role->name, $userRoles) ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Roles</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
