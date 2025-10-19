@extends('layouts.master')

@section('title', 'Create Role')

@section('content')
    <div class="container">
        <h1>Create Role</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('roles.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Role Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Permissions</label><br>
                @foreach ($permissions as $perm)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="perm-{{ $perm->id }}" name="permissions[]"
                            value="{{ $perm->id }}"
                            {{ is_array(old('permissions')) && in_array($perm->id, old('permissions')) ? 'checked' : '' }}>
                        <label class="form-check-label" for="perm-{{ $perm->id }}">{{ $perm->name }}</label>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary">Create Role</button>
            <a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
