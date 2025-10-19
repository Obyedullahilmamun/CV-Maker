@extends('layouts.master')

@section('title', 'Edit Role')

@section('content')
    <div class="container">
        <h2>Edit Role: {{ $role->name }}</h2>

        <form method="POST" action="{{ route('roles.update', $role->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Role Name</label>
                <input type="text" class="form-control" name="name" value="{{ $role->name }}">
            </div>

            {{-- <div class="mb-3">
                <label class="form-label">Permissions</label><br>
                @foreach ($permissions as $perm)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="permission[]" value="{{ $perm->id }}"
                            {{ in_array($perm->id, $rolePermissions) ? 'checked' : '' }}>
                        <label class="form-check-label">{{ $perm->name }}</label>
                    </div>
                @endforeach
            </div> --}}

            @php
                $groups = [
                    'Dashboard' => ['dashboard.view'],
                    'Index' => ['index.view', 'index.edit', 'index.delete'],
                    'Form' => ['form.submit'],
                    'Users' => ['users.view', 'users.edit', 'users.delete'],
                    'Roles' => ['roles.view', 'roles.edit', 'roles.delete'],
                ];
            @endphp

            @foreach ($groups as $group => $perms)
                <div class="mb-2">
                    <strong>{{ $group }}</strong><br>
                    @foreach ($permissions->whereIn('name', $perms) as $perm)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="permission[]" value="{{ $perm->id }}"
                                {{ in_array($perm->id, $rolePermissions) ? 'checked' : '' }}>
                            <label class="form-check-label">{{ $perm->name }}</label>
                        </div>
                    @endforeach
                </div>
            @endforeach

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
